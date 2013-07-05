<?php

/**
 * This is the model class for table "{{territory_target}}".
 *
 * The followings are the available columns in table '{{territory_target}}':
 * @property integer $id
 * @property integer $territory_id
 * @property string $periode
 * @property double $target
 * @property string $create_at
 */
class TerritoryTarget extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TerritoryTarget the static model class
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
		return '{{territory_target}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('territory_id, periode, target', 'required'),
			array('territory_id', 'numerical', 'integerOnly'=>true),
			array('target', 'numerical'),
			array('create_at','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, territory_id, periode, target, create_at', 'safe', 'on'=>'search'),
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
			'territory_id' => 'Territory',
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
		$criteria->compare('territory_id',$this->territory_id);
		$criteria->compare('periode',$this->periode,true);
		$criteria->compare('target',$this->target);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'periode asc, territory_id asc',
			),
		));
	}

	public function getTrTarget($teritory, $periode){
		$data = Yii::app()->db->createCommand()
		    ->select()
		    ->from('tbl_territory_target')
		    ->where('id=:id AND periode=:periode', array(':id'=>$teritory, ':periode'=>$periode))
		    ->queryRow();

		return $data['target'];
	}

	public function getSakTarget($teritory, $periode){
		$periode = '%'. $periode . '%';
		$teritory = '%'. $teritory . '%';
		$balance = Yii::app()->db->createCommand()
			->select('SUM(quantity) as qty')
			->from('tbl_sales_report')
			->where('territory like :teritory AND uom like "Sak 40kg" AND posting_date like :cha', array(':teritory'=>$teritory, ':cha'=>$periode));
		$periodeQty = $balance->queryAll();
		if ($periodeQty) return ($periodeQty[0]['qty']*0.04);
		else return "000";
	}

	public function getKgTarget($teritory, $periode){
		$periode = '%'. $periode . '%';
		$teritory = '%'. $teritory . '%';
		$balance = Yii::app()->db->createCommand()
			->select('SUM(quantity) as qty')
			->from('tbl_sales_report')
			->where('territory=:teritory AND uom like "Kg" AND posting_date like :cha', array(':teritory'=>$teritory, ':cha'=>$periode));
		$periodeQty = $balance->queryAll();
		if ($periodeQty) return ($periodeQty[0]['qty']*0.001);
		else return "000";
	}
}
