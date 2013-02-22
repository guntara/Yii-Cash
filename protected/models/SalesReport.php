<?php

/**
 * This is the model class for table "{{sales_report}}".
 *
 * The followings are the available columns in table '{{sales_report}}':
 * @property integer $id
 * @property string $id_SO
 * @property string $id_DO
 * @property string $id_invoice
 * @property string $posting_date
 * @property string $due_date
 * @property string $customer
 * @property double $quantity
 * @property string $uom
 * @property string $territory
 * @property string $sales_term
 * @property double $total
 * @property integer $status
 * @property string $payment_date
 * @property string $create_at
 * @property string $update_at
 */
class SalesReport extends CActiveRecord
{
	public $temp;
	public $ageDays;
	public $lateDays;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalesReport the static model class
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
		return '{{sales_report}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_SO, id_DO, id_invoice, posting_date, due_date, customer, quantity, uom, territory, sales_term, total, payment_date, create_at', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('quantity, total', 'numerical'),
			array('id_SO, id_DO, id_invoice, uom', 'length', 'max'=>10),
			array('customer, sales_term', 'length', 'max'=>50),
			array('territory', 'length', 'max'=>20),
			array('update_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_SO, id_DO, id_invoice, posting_date, due_date, customer, quantity, uom, territory, sales_term, total, status, payment_date, create_at, update_at', 'safe', 'on'=>'search'),
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
			'id_SO' => 'SO',
			'id_DO' => 'DN',
			'id_invoice' => 'Invoice',
			'posting_date' => 'Posting Date',
			'due_date' => 'Due Date',
			'customer' => 'Customer',
			'quantity' => 'Qty',
			'uom' => 'UOM',
			'territory' => 'Territory',
			'sales_term' => 'Sales Term',
			'total' => 'Total',
			'status' => 'Status',
			'payment_date' => 'Payment Date',
			'create_at' => 'Create At',
			'update_at' => 'Update At',
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
		$criteria->compare('id_SO',$this->id_SO,true);
		$criteria->compare('id_DO',$this->id_DO,true);
		$criteria->compare('id_invoice',$this->id_invoice,true);
		$criteria->compare('posting_date',$this->posting_date,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('customer',$this->customer,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('uom',$this->uom,true);
		$criteria->compare('territory',$this->territory,true);
		$criteria->compare('sales_term',$this->sales_term,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('status',$this->status);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'id desc',
			),
		));
	}

	public function paymentstatus($id)
	{
		$criteria = new CDbCriteria;
		if($id==1) $criteria->condition = '`status`=0 AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) >= `due_date`';
		if($id==2) $criteria->condition = '`status`=0 AND `due_date`> DATE_ADD(CURDATE(), INTERVAL -7 DAY) AND `due_date` <= CURDATE()';
		if($id==3) $criteria->condition = '`status`=0 AND `due_date`>= CURDATE() AND `due_date` <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'due_date desc',
			),
		));
	}

	public function dailyar()
	{
		$criteria = new CDbCriteria; //SELECT * FROM `tbl_sales_report` WHERE DATE(`update_at`)=CURDATE()
		$criteria->condition = 'DATE(`update_at`)=CURDATE()';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'due_date desc',
			),
		));
	}

	public function weeklyar()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'DATE(`update_at`) > DATE_ADD(CURDATE(), INTERVAL -7 DAY)';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'due_date desc',
			),
		));
	}

	public function weeklydn()
	{
		$criteria = new CDbCriteria;
		$criteria->condition = '`posting_date` > DATE_ADD(CURDATE(), INTERVAL -7 DAY)';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'posting_date asc',
			),
		));
	}
}
