<?php

/**
 * This is the model class for table "{{sales_target}}".
 *
 * The followings are the available columns in table '{{sales_target}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $periode
 * @property double $target
 * @property string $create_at
 */
class SalesTarget extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SalesTarget the static model class
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
		return '{{sales_target}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, periode, target', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('target', 'numerical'),
			array('create_at','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, periode, target, create_at', 'safe', 'on'=>'search'),
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
			'user_id' => 'Sales Person',
			'periode' => 'Periode',
			'target' => 'Target',
			'create_at' => 'Create At',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('periode',$this->periode,true);
		$criteria->compare('target',$this->target);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'periode asc, user_id asc',
			),
		));//SELECT SUM(quantity) AS qty FROM  `tbl_sales_report` WHERE `user_id`=9 AND `posting_date` LIKE "%2013-02%"
	}

	public function getMyTarget($user, $periode){
		$data = Yii::app()->db->createCommand()
		    ->select()
		    ->from('tbl_sales_target')
		    ->where('user_id=:id AND periode=:periode', array(':id'=>$user, ':periode'=>$periode))
		    ->queryRow();

		return $data['target'];
	}

	public function getSakTarget($user, $periode){
		$periode = '%'. $periode . '%';
		$balance = Yii::app()->db->createCommand()
			->select('SUM(quantity) as qty')
			->from('tbl_sales_report')
			->where('user_id=:user AND uom like "Sak 40kg" AND posting_date like :cha', array(':user'=>$user, ':cha'=>$periode));
		$periodeQty = $balance->queryAll();
		if ($periodeQty) return ($periodeQty[0]['qty']*0.04);
		else return "000";
	}

	public function getKgTarget($user, $periode){
		$periode = '%'. $periode . '%';
		$balance = Yii::app()->db->createCommand()
			->select('SUM(quantity) as qty')
			->from('tbl_sales_report')
			->where('user_id=:user AND uom like "Kg" AND posting_date like :cha', array(':user'=>$user, ':cha'=>$periode));
		$periodeQty = $balance->queryAll();
		if ($periodeQty) return ($periodeQty[0]['qty']*0.001);
		else return "000";
	}
}
