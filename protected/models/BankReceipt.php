<?php

/**
 * This is the model class for table "{{bank_receipt}}".
 *
 * The followings are the available columns in table '{{bank_receipt}}':
 * @property integer $id
 * @property string $tanggal
 * @property string $keterangan
 * @property double $jumlah
 * @property string $bank
 * @property string $cabang
 * @property string $create_at
 */
class BankReceipt extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BankReceipt the static model class
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
		return '{{bank_receipt}}';
	}

	public $allocate, $temp;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tanggal, create_at', 'required'),
			array('jumlah, status', 'numerical'),
			array('keterangan', 'length', 'max'=>2000),
			array('bank, cabang', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tanggal, keterangan, jumlah, bank, cabang, create_at', 'safe', 'on'=>'search'),
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
			'tanggal' => 'Tanggal',
			'keterangan' => 'Keterangan',
			'jumlah' => 'Jumlah',
			'bank' => 'Bank',
			'cabang' => 'Cabang',
			'status' => 'Status',
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
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('cabang',$this->cabang,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_at',$this->create_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
			'sort' => array(
				'defaultOrder' => 'tanggal desc',
			),
		));
	}
}
