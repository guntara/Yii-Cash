<?php

class BankReceiptController extends Controller
{
	public $arrAR;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		$arrAR = Users::model()->getAllAR();
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','update','cash'),
				'users'=>$arrAR,
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','cash','delete'),
				'users'=>Yii::app()->getModule('user')->getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		/*$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/

		$this->render('update',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BankReceipt;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BankReceipt']))
		{
			$model->attributes=$_POST['BankReceipt'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BankReceipt']))
		{
			$model->attributes=$_POST['BankReceipt'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BankReceipt');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BankReceipt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BankReceipt']))
			$model->attributes=$_GET['BankReceipt'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=BankReceipt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bank-receipt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

//---------------------
	public function getAmount($data, $row)
	{
		$data = Yii::app()->db->createCommand()
		    ->select()
		    ->from('tbl_sales_report')
		    ->where('id_SO=:id or id_DO=:id or id_invoice=:id', array(':id'=>$data->id_salesReport))
		    ->queryRow();

		return number_format($data['total'], 2);
	}

	public function actioncash()
	{
		unset(Yii::app()->request->cookies['from_date']);  // first unset cookie for dates
		unset(Yii::app()->request->cookies['to_date']);

		$model=new BankReceipt('cashbydate');
		$model->unsetAttributes();

		if(!empty($_POST))
		{
			Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_POST['from_date']);
			Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_POST['to_date']);
		}

		if(isset($_GET['BankReceipt']))
			$model->attributes=$_GET['BankReceipt'];

		$this->render('cash',array(
			'model'=>$model,
		));
	}
//---------------------

}
