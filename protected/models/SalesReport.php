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
 * @property integer $user_id
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
			array('id_SO, id_DO, id_invoice, posting_date, due_date, customer, quantity, uom, territory, user_id, sales_term, total', 'required'),
			array('user_id, status', 'numerical', 'integerOnly'=>true),
			array('quantity, total', 'numerical'),
			array('update_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_SO, id_DO, id_invoice, posting_date, due_date, customer, quantity, uom, territory, user_id, sales_term, total, status, payment_date, create_at, update_at', 'safe', 'on'=>'search'),
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
			'user_id' => 'Sales Person',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('sales_term',$this->sales_term,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('status',$this->status);
		$criteria->compare('payment_date',$this->payment_date,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('update_at',$this->update_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 25,
			),
			'sort' => array(
				'defaultOrder' => 'posting_date DESC, id_SO desc',
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

	public function cashin($month)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'YEAR(`due_date`) = YEAR(now()) AND MONTH(`due_date`) = MONTH(DATE_SUB(NOW(), INTERVAL '. $month.' MONTH))';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'due_date asc',
			),
		));
	}

	public function filterSales()
	{
		$id = User::model()->findAllByAttributes(array('username'=>$value));
		$data = Profiles::model()->findByPK($id[0]['id']);
		$arrSM = Users::model()->getAllSales();
		$codes = self::model()->findAll();
		$data = array();
		foreach ($codes as $c) {
			$data[$c->id] = $c->code;
		}
		return $data;
	}

	public function filterCustomer()
	{
		$codes=SalesReport::model()->findAll(array(
			'select'=>'customer',
			'distinct'=>true,
			'order'=>'customer ASC',
		));

		$data = array();
		foreach ($codes as $c) {
			$data[$c->customer] = $c->customer;
		}
		return $data;
	}

	public function totalPay($id)
	{
		$criteria = new CDbCriteria;
		if($id==1) $provider = $this->findAll('`status`=0 AND DATE_SUB(CURDATE(),INTERVAL 7 DAY) >= `due_date`');
		if($id==2) $provider = $this->findAll('`status`=0 AND `due_date`> DATE_ADD(CURDATE(), INTERVAL -7 DAY) AND `due_date` <= CURDATE()');
		if($id==3) $provider = $this->findAll('`status`=0 AND `due_date`>= CURDATE() AND `due_date` <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)');

		$totalPay=0;
		$countPay=0;
		//$provider = $model->findAll('id_bankReceipt = :idBR',array(':idBR'=>$id_bR));
		foreach($provider as $data)
		{
			$totalPay += $data->total;
			$countPay++;
		}
		return $totalPay.'_'.$countPay;
	}

	public function totalCashin($month)
	{
		$hasil = array();
		$provider = $this->findAll('YEAR(`due_date`) = YEAR(now()) AND MONTH(`due_date`) = MONTH(DATE_SUB(NOW(), INTERVAL '. $month.' MONTH))');

		$actualPaid=0;
		$countPaid=0;
		$expectedPaid=0;
		$totalInv=0;
		$fullPaid=0;
		foreach($provider as $data){
			if($data->status == 1) $countPaid++;
			$actualPaid += Allocate::model()->getPayedSR($data->id);
			$expectedPaid += $data->total; $totalInv++;
		}
		$hasil[1] = $countPaid; $hasil[2] = $totalInv; $hasil[3] = $expectedPaid; $hasil[4] = $actualPaid;
		return $hasil;
	}
}
