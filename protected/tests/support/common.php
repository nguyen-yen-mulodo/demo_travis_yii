<?php
class Common {
	public function login($data) {
		$auth = new UserIdentity ( $data ['username'], $data ['password'] );
		$auth->authenticate ();
		return $auth->getId ();
	}
	public function logout() {
		Yii::app ()->user->logout ();
		unset ( $_SESSION );
	}

}