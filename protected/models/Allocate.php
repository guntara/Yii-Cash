<?php

/**
 * This is the model class for table "{{allocate}}".
 *
 * The followings are the available columns in table '{{allocate}}':
 * @property integer $id
 * @property string $id_bankReceipt
 * @property string $id_salesReport
 * @property string $user_allocate
 * @property double $amount
 * @property string $remarks
 * @property integer $status
 * @property string $create_at
 * @property string $last_modify
 */
class Allocate extends CActiveRecord
{
	public $temp;
	public $valid;
	public $salesTotal;
	public $tanggal;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Allocate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{allocate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		$un = User::model()->findByPk(Yii::app()->user->id);
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_bankReceipt, id_salesReport, amount, remarks', 'required'),
			array('amount, valid', 'numerical'),
			array('last_modify, tanggal', 'safe'),
			array('user_allocate','default', 'value'=>$un->username, 'setOnEmpty'=>false, 'on'=>'insert'),
			array('user_allocate','default', 'value'=>$un->username, 'setOnEmpty'=>false, 'on'=>'update'),
			array('create_at','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			array('last_modify','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_bankReceipt, id_salesReport, user_allocate, amount, remarks, status, create_at, last_modify', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_bankReceipt' => 'ID Bank Receipt',
			'id_salesReport' => 'ID Sales Report',
			'user_allocate' => 'User Allocate',
			'amount' => 'Amount',
			'remarks' => 'Remarks',
			'status' => 'Status',
			'create_at' => 'Create At',
			'last_modify' => 'Last Modify',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_bankReceipt',$this->id_bankReceipt,true);
		$criteria->compare('id_salesReport',$this->id_salesReport,true);
		$criteria->compare('user_allocate',$this->user_allocate,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('last_modify',$this->last_modify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave(){
		$totalAl = $this->getTotAl($this->id_bankReceipt);
		$totalBR = $this->getTotBR($this->id_bankReceipt);
		$totalSR = floor($this->getTotSR($this->id_salesReport) % 10) * 10;
		$payed = $this->getPayedSR($this->id_salesReport);
		
		if(($totalBR - $totalAl) < $this->amount) {
			$this->addError('amount', 'Allocate payment can\'t greather than current bank transfer!');
			return false; 
		}

		if (parent::beforeSave()) {	return true;	}
	}

//---------------------
	public function getAllocate($id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = "`id_bankReceipt`=$id";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 5,
			),
			'sort' => array(
				'defaultOrder' => 'id desc',
			),
		));
	}

	public function getTotAl($idBR)
	{
		$totalPay=0;
		$provider = Allocate::model()->findAll('id_bankReceipt = :idBR',array(':idBR'=>$idBR));
		foreach($provider as $data)
		{
			$totalPay += $data->amount;
		}
		return $totalPay;
	}

	public function getTotBR($idBR)
	{
		$data = BankReceipt::model()->findByPk($idBR);
		return $data->jumlah;
	}

	public function getTotSR($idSR)
	{
		$data = Yii::app()->db->createCommand()
		    ->select()
		    ->from('tbl_sales_report')
		    ->where('id_SO=:id or id_DO=:id or id_invoice=:id', array(':id'=>$idSR))
		    ->queryRow();
		return $data['total'];
	}

	public function getPayedSR($idSR)
	{
		$SR = Yii::app()->db->createCommand()
		    ->select()
		    ->from('tbl_sales_report')
		    ->where('id=:id or id_SO=:id or id_DO=:id or id_invoice=:id', array(':id'=>$idSR))
		    ->queryRow();

		$salesRep = Yii::app()->db->createCommand()
		    ->select('sum(amount) as totAmount')
		    ->from('tbl_allocate')
		    ->where('id_salesReport=:id_SO or id_salesReport=:id_DO or id_salesReport=:id_INV', array(':id_SO'=>$SR['id_SO'], ':id_DO'=>$SR['id_DO'], ':id_INV'=>$SR['id_invoice']))
		    ->queryRow();

		return $salesRep['totAmount'];
	}
//---------------------
}
