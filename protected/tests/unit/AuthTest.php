<?php
// require 'provider/authProvider.php';




class AuthTest extends CDbTestCase {
	public $fixtures = array (
			'user' => ':tbl_user' 
	);
	
	
	
	
	
	
	
	public function validate_provider() {
		return array (
				array (
						array (
								'username' => 'admin',
								'password' => '123456' 
						) 
				),
			
				array (
						array (
								'username' => 'vo.yen',
								'password' => '123456' 
						) 
				),
// 				array (
// 						array (
// 								'username' => '#$#@',
// 								'password' => 'ro$@$ot' 
// 						) 
// 				),
// 				array (
// 						array (
// 								'username' => 'admin124',
// 								'password' => '123456'
// 						)
// 				),
		);
	}
	public function auth_true_provider() {
		return array (
				array (
						array (
								'username' => 'admin',
								'password' => '123456' 
						) 
				) 
		);
	}
	public function auth_false_provider() {
		return array (
				array (
						array (
								'username' => 'admin',
								'password' => '123456333' 
						) 
				) 
		);
	}
	
	public function login_provider() {
		return array (
				array (
						array (
								'username' => 'vo.yen',
								'password' => '123456'
						)
				)
		);
	}
	
	protected function tearDown()
	{
		$this->logout();
	}
	/**
	 * @dataProvider validate_provider
	 */
	public function testValidate($data) {
// 		echo '<pre>';
// 		var_dump($this->user['account1']);
// 		echo '</pre>';die;
		
		$login = new LoginForm ();
		$login->attributes = $data;
		$this->assertTrue ( $login->validate () );
	}
	
	/**
	 * @dataProvider auth_true_provider
	 */
	public function testTrueAuthentcation($data) {
		$auth = new UserIdentity ( $data ['username'], $data ['password'] );
		$this->assertTrue ( $auth->authenticate () );
	}
	
	/**
	 * @dataProvider auth_false_provider
	 */
	public function testFalseAuthentcation($data) {
		$auth = new UserIdentity ( $data ['username'], $data ['password'] );
		$this->assertFalse ( $auth->authenticate () );
	}
	
	/**
	 * @dataProvider auth_true_provider
	 */
	public function testGetId($data) {
		$auth = new UserIdentity ( $data ['username'], $data ['password'] );
		$auth->authenticate ();
		$this->assertEquals ( 1, $auth->getId () );
	}
	
	/**
	 * @dataProvider auth_true_provider
	 */
	public function testLoginLogout($data)
	{
		//unset($_SESSION);
		$identity = new UserIdentity($data['username'], $data['password']);
		$identity->authenticate();
		Yii::app()->user->login($identity);
	
		$this->checkUser();
	
		$this->logout();  echo "logout()";
		$this->checkUser();
	}
	
	protected function logout()
	{
		Yii::app()->user->logout();
		unset($_SESSION);
	}
	private function checkUser()
	{
		echo "\n\nStatus of current user:\n";
		echo "--------------------------\n";
		echo "User ID: ".Yii::app()->user->id."\n";
		echo "User Name: ".Yii::app()->user->name."\n";
		if (Yii::app()->user->isGuest)
			echo "There is NO user logged in.\n\n";
		else
			echo "The user is logged in.\n\n";
	}

}
