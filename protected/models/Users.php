<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property string $create_at
 * @property string $lastvisit_at
 * @property integer $superuser
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Profiles $profiles
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, create_at', 'required'),
			array('superuser, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password, email, activkey', 'length', 'max'=>128),
			array('lastvisit_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, activkey, create_at, lastvisit_at, superuser, status', 'safe', 'on'=>'search'),
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
			'profiles' => array(self::HAS_ONE, 'Profiles', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'activkey' => 'Activkey',
			'create_at' => 'Create At',
			'lastvisit_at' => 'Lastvisit At',
			'superuser' => 'Superuser',
			'status' => 'Status',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('activkey',$this->activkey,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('lastvisit_at',$this->lastvisit_at,true);
		$criteria->compare('superuser',$this->superuser);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/** ------------------------------------------------- ADDED CODE -------------------------------------------------  **/
	public function searchUser($user){
		$criteria=new CDbCriteria;
		$criteria->condition='username like "%'.$user.'%" OR email like "%'.$user.'%"';
		$result=Users::model()->findAll($criteria);
		$arr=array();
		if($result){
			foreach($result as $val){
				$arr[]=$val->id;
			}
		}
		return $arr;
	}
	public function getUserList(){
		$cr= new CDbCriteria;
		$arr=array();
		$mods = UserRoles::model()->findAll();
		$userid="";
		foreach($mods as $mod)
		{
			$userid .=" AND id <>". $mod->user_id;
		
		}
		$cr->condition="id <> 0 ".$userid;
		
		if($users= Users::model()->findAll($cr)){
		 	foreach($users as $user){
				$arr[$user->id]=$user->name." - ".$user->email;
			}	
		}
		else
			$arr[0]="No Users";
		return $arr;
	}
	public function getUserList2(){
		$cr= new CDbCriteria;
		$arr=array();
		$mods = Accessibility::model()->findAll();
		$userid="";
		foreach($mods as $mod){
			$userid .=" AND id <>". $mod->user_id;
		
		}
		$cr->condition="id <> 0 ".$userid;
		
		if($users= Users::model()->findAll($cr)){
		 	foreach($users as $user){
				$arr[$user->id]=$user->username." - ".$user->email;
			}	
		}
		else
			$arr[0]="No Users";
		return $arr;
	}
	/** ----------------------------------------------- END ADDED CODE -----------------------------------------------  **/

	public function getAllAR() {
		$criteria=new CDbCriteria;
		$criteria->condition='dept like "%AR%" OR dept like "%Accounting%"';
		$result=Profiles::model()->findAll($criteria);
		foreach($result as $result){
			$user = User::model()->findByPK($result->user_id);
			$userAR[] = $user->username;
		}
		return $userAR;
	}

	public function getAllSales() {
		$criteria=new CDbCriteria;
		$criteria->condition='dept like "%Sales%" OR dept like "%Marketing%"';
		$result=Profiles::model()->findAll($criteria);
		foreach($result as $result){
			$user = User::model()->findByPK($result->user_id);
			$userSM[] = $user->username;
		}
		$user = User::model()->findByPK(1);
		$userSM[] = $user->username;
		return $userSM;
	}

	public function getListSales(){
		$cr= new CDbCriteria;
		$cr->condition='dept like "%Sales%" OR dept like "%Marketing%"';
		$arr=array();
		
		if($users= Profiles::model()->findAll($cr)){
		 	foreach($users as $user){
				$arr[$user->user_id]=$user->firstname." ".$user->lastname;
			}	
		}
		else
			$arr[0]="No Users";
		return $arr;
	}
}
