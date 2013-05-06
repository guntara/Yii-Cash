<?php

/**
 * This is the model class for table "{{accessibility}}".
 *
 * The followings are the available columns in table '{{accessibility}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $ip
 * @property string $multiple_ip
 * @property string $ip_range1
 * @property string $ip_range2
 */
class Accessibility extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Accessibility the static model class
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
		return '{{accessibility}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
           		array('user_id', 'unique', 'message'=>'Accessiblity rule has already been defined to this user.'),
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
			'user_id' => 'User',
			'ip' => 'IP',
			'multiple_ip' => 'Multiple IP',
			'ip_range1' => 'Start IP',
			'ip_range2' => 'End IP',
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
		$criteria->compare('ip',$this->ip,true);
        	//$criteria->addInCondition('user_id', Yii::app()->Users::searchUser($this->user_id));
		/*$criteria->compare('user_id',$this->user_id);
		$criteria->compare('multiple_ip',$this->multiple_ip,true);
		$criteria->compare('ip_range1',$this->ip_range1,true);
		$criteria->compare('ip_range2',$this->ip_range2,true);*/

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
