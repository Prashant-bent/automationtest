<?php
namespace  frontend\tests\functional 
 use frontend\tests\functionaltester;
 use common\fixtures\userfixtures;

 class logincest
 {
 	public function _fixtures()
 	{
 		return [
 			'user' => [
 				'class' =>Userfixture::className(),
 				'datafile' =>codecept_data_dir() . 'login_data.php'

 			],
 		];
 	}

 	public function _before(FunctionalTester $I)
 	{
 		$I->amOnRoute('site/login');
 	}
 	protected function formparams($login, $password)
 	{
 		return [
 			'Loginform[username]' => $login,
 			'Loginform[password]' => $password,
 		];
   }
   public function checkEmpty(FunctionalTester $I)
   {
   	$I->submitForm('#login-form', $this->formparams('',''));
   	$I->seevalidationerror('Username can not be blank.');
   	$I->seevalidationerror('Password can not be blank.');
   }
   public function checkwrongpassword(Functional Tester $I)
   {
   	$I->submitform('#login-form', $this->formparams('admin','wrong'));
   	$I->seevalidationerror('Invalid Credentials.');
   }
   public function checkinactiveaccount(Functional Tester $I)
   {
   	$I->submitform('#login-form', $this->formparams('test','test123'));
   	$I->seevalidationerror('Invalid Credentials.');

   }
   public function checkValidLogin(Functional Tester $I)
   {
   	$I->submitform('#loginform', $this->params('admin','testadmin'));
    $I->see('Logout(admin)','form button[type=submit]');
    $I->dontseelink('Login');
    $I->dontseelink('Signup');
   }
 }