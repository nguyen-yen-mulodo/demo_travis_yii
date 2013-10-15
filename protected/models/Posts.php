<?php

/**
 * This is the model class for table "tbl_posts".
 *
 * The followings are the available columns in table 'tbl_posts':
 * @property integer $pid
 * @property string $title
 * @property string $content
 * @property integer $uid
 * @property integer $create_dt
 * @property integer $update_dt
 * @property integer $cid
 */
class Posts extends BaseModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, uid, create_dt, cid', 'required'),
			array('uid, create_dt, update_dt, cid', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pid, title, content, uid, create_dt, update_dt, cid', 'safe', 'on'=>'search'),
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
				'getCategory' => array(self::BELONGS_TO, 'Category', 'cid'),
				'getUser' => array(self::BELONGS_TO, 'User', 'uid'),
				'getCategoryTitle' => array(self::BELONGS_TO, 'Category', 'title'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pid' => 'Post id',
			'title' => 'Title',
			'content' => 'Content',
			'uid' => 'Author',
			'create_dt' => 'Create Dt',
			'update_dt' => 'Update Dt',
			'cid' => 'Category',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('pid',$this->pid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('create_dt',$this->create_dt);
		$criteria->compare('update_dt',$this->update_dt);
		$criteria->compare('cid',$this->cid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Posts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getListCategory()
	{
		$category = new Category();
		$data = $category->findAll();
		return $data;
	}
	
	public function scopes()
	{
		return array(
				'getUser'=>array(self::BELONGS_TO, 'User','uid'), // this will be in Users model
		);
	}
	
	public function saveModel($data=array())
	{
		
		$session = Yii::app ()->session ['user_info'];
		$data['uid'] = $session['id'];
		$data['create_dt'] = $data['update_dt'] = time();
	
		$this->attributes=$data;

		if(!$this->save())
			return CHtml::errorSummary($this);
	
		return true;
	}
}
