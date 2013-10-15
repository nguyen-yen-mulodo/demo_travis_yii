<?php
class UserTest extends CDbTestCase {
	public $fixtures = array (
			'user' => ':tbl_user' 
	);
	private static $id;
	
	public static function setUpBeforeClass() {
		
	}
	
	// protected function setUp()
	// {
	// $auth = new Common();
	// $this->id = $auth->login(array (
	// 'username' => 'vo.yen',
	// 'password' => '123456'
	// ));
	// }
	
	
	public function testSaveModel($data) {
// 		echo '<pre>';
// 		var_dump(self::$id);
// 		echo '</pre>';die;
            echo "sdf";
		var_dump($this->user);
	}
}
