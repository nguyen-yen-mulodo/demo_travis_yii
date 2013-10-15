<?php

class SiteTest extends WebTestCase
{
	public function testIndex()
	{
		$this->open('');
		$this->assertTextPresent('Welcome');
	}
	
	public function testContact()
	{
		$this->open('site/contact');
		$this->assertTextPresent('Contact Us');
		$this->assertElementPresent('name=ContactForm[name]');

		$this->type('name=ContactForm[name]','tester');
		$this->type('name=ContactForm[email]','tester@example.com');
		$this->type('name=ContactForm[subject]','test subject');
		$this->click("//input[@value='Submit']");
		$this->waitForTextPresent('Body cannot be blank.');
	}

	public function testLoginLogout()
	{
		$this->open('');
		// ensure the user is logged out
		if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout (demo)');

		// test login process, including validation
		$this->clickAndWait('link=Login');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','demo');
		$this->click("//input[@value='Login']");
		$this->waitForTextPresent('Password cannot be blank.');
		$this->type('name=LoginForm[password]','123456');
		$this->clickAndWait("//input[@value='Login']");
		$this->assertTextNotPresent('Password cannot be blank.');
		$this->assertTextPresent('Logout');

		// test logout process
		$this->assertTextNotPresent('Login');
		$this->clickAndWait('link=Logout (demo)');
		$this->assertTextPresent('Login');
	}
	
	// 	protected function setUp()
	//   {
	//     $this->setBrowser("*firefox");
	//     $this->setBrowserUrl("https://www.google.com.vn/");
	//   }
	
	//   public function testMyTestCase()
	//   {
	//     $this->open("/");
	//     $this->click("id=gbqfba");
	//     $this->click("id=gbqfba");
	//     $this->click("link=Chương trình Quảng cáo");
	//     $this->waitForPageToLoad("30000");
	//     $this->click("link=Bắt đầu");
	//     $this->waitForPageToLoad("30000");
	//     $this->click("link=exact:Google AdWords là gì?");
	//     $this->waitForPopUp("google_popup", "30000");
	//   }
	
	
}
