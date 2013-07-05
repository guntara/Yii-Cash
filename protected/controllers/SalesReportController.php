<?php

class SalesReportController extends Controller
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
				'actions'=>array('admin','cashin','dailyar','update','paymentstatus','weeklyar','weeklydn'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','delete'),
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
		$model=new SalesReport;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SalesReport']))
		{
			$model->attributes=$_POST['SalesReport'];
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

		if(isset($_POST['SalesReport']))
		{
			$model->attributes=$_POST['SalesReport'];
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SalesReport');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SalesReport('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SalesReport']))
			$model->attributes=$_GET['SalesReport'];

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
		$model=SalesReport::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sales-report-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

// ----------------------------
	public function namaUser($data)
	{
		$data = Profiles::model()->findByPK($data->user_id);
		$nama = $data->firstname . ' ' . $data->lastname;
		return $nama;
	}

	public function agetime($data)
	{
		if ($data->status == 0) {
			$command = Yii::app()->db->createCommand();
			$users = $command->select("DATEDIFF('$data->due_date', NOW()) as ageDays")->from('tbl_sales_report')->queryAll();
			return $users[0]['ageDays'].' days';
		} else { return '-'; }
	}

	public function lateTime($data)
	{
		$command = Yii::app()->db->createCommand();
		if ($data->payment_date=='0000-00-00') {
			$users = $command->select("DATEDIFF('$data->due_date', NOW()) as lateDays")->from('tbl_sales_report')->queryAll();
		} else {
			$users = $command->select("DATEDIFF('$data->due_date', '$data->payment_date') as lateDays")->from('tbl_sales_report')->queryAll();
		}
		return $users[0]['lateDays'].' days';
	}

	public function actionpaymentstatus()
	{
		$this->render('paymentstatus');
	}

	public function actiondailyar()
	{
		$this->render('dailyar');
	}

	public function actionweeklyar()
	{
		$this->render('weeklyar');
	}

	public function actionweeklydn()
	{
		$this->render('weeklydn');
	}

	public function actionCashIn()
	{
		$model=new SalesReport('search');
		$model->unsetAttributes();  // clear any default values

		$this->render('cashin',array(
			'model'=>$model,
		));
	}
// ----------------------------
}
