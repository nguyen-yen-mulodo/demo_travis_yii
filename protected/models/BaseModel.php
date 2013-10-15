<?php
abstract class BaseModel extends CActiveRecord {

	public function getDateFormat($data) {
		$date = $this->$data;
		return date('Y/m/d H:i:s',$date);
	}
	
	public function getCategory()
	{
		$cid = $this->cid;
		$data = Posts::model()->findByPk($cid);
		return $data->title;
	}
	
	public function getAuthor()
	{
		$uid = $this->uid;
		$data = User::model()->findByPk($uid);
		return $data->username;
	}
}
