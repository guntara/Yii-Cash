<?php

class AllocateController extends Controller
{
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
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','update','listing','testvalue'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				//'users'=>array('admin'),
				'users'=>Yii::app()->getModule('user')->getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

//---------------------
	public function actionListing()
	{
		$data1=SalesReport::model()->findAll('status = :status ORDER BY id_SO',array(':status'=>"0"));
		$data2=SalesReport::model()->findAll('status = :status ORDER BY id_DO',array(':status'=>"0"));
		$data3=SalesReport::model()->findAll('status = :status ORDER BY id_invoice',array(':status'=>"0"));
		if ($_POST['allocate_id']==4)
		{
			echo CHtml::tag('option', array('value'=>'Cash'),CHtml::encode('Cash'),true);
			echo CHtml::tag('option', array('value'=>'Giro'),CHtml::encode('Giro'),true);
		}
		else
		{
			if ($_POST['allocate_id']==1) $data=CHtml::listData($data1, 'id_SO', 'id_SO');
			if ($_POST['allocate_id']==2) $data=CHtml::listData($data2, 'id_DO', 'id_DO');
			if ($_POST['allocate_id']==3) $data=CHtml::listData($data3, 'id_invoice', 'id_invoice');
			foreach($data as $value=>$name)
			{
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			}
		}
	}
//---------------------

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Allocate;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Allocate']))
		{
			$model->attributes=$_POST['Allocate'];
			if($model->save())
			{
				$idSR = $this->getIdSR($model->id_salesReport);
				$sql = 'UPDATE `tbl_sales_report` SET `status`=1, `payment_date`=\''. $model->tanggal .'\' WHERE id='. $idSR .'';
				Yii::app()->db->createCommand($sql)->execute();
				$this->redirect(array('bankReceipt/view','id'=>$model->id_bankReceipt));
			}
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

		if(isset($_POST['Allocate']))
		{
			$model->attributes=$_POST['Allocate'];
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
		$dSR = $this->getDetSR($id);
		if($this->loadModel($id)->delete())
		{
			$idSR = $this->getIdSR($dSR);
			$sql = 'UPDATE `tbl_sales_report` SET `status`=0, `payment_date`=\'0000-00-00\' WHERE id='. $idSR .'';
			Yii::app()->db->createCommand($sql)->execute();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Allocate');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Allocate('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Allocate']))
			$model->attributes=$_GET['Allocate'];

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
		$model=Allocate::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='allocate-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

//---------------------
	public function getIdSR($kw)
	{
		$data = Yii::app()->db->createCommand()
		    ->select()
		    ->from('tbl_sales_report')
		    ->where('id_SO=:id or id_DO=:id or id_invoice=:id', array(':id'=>$kw))
		    ->queryRow();

		return $data['id'];
	}

	public function getDetSR($idA)
	{
		$data = Allocate::model()->findByPk($idA);
		return $data->id_salesReport;
	}

	public function getDate($idBR)
	{
		$data = BankReceipt::model()->findByPk($idBR);
		return $data->tanggal;
	}
//---------------------

}
