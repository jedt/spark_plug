<?php
App::import('model','SparkPlug.User');

class UserTest extends CakeTestCase
{
	var $fixtures = array('plugin.spark_plug.user',
							'plugin.spark_plug.login_token',
							'plugin.spark_plug.user_group',
							'plugin.spark_plug.user_group_permission',
							'plugin.spark_plug.company');
	function startTest()
	{
		$this->User =& ClassRegistry::init('User');
	}
	function testChangePassword()
	{
		$data['User']['id'] = '1';
		$data['User']['password'] = '1234';
		$data['User']['confirm_password'] = '1234';
		$result = $this->User->changePassword($data);
		$this->assertTrue($result);
	}
	function testChangePasswordError()
	{
		$data['User']['id'] = '1';
		$data['User']['password'] = '1234';
		$data['User']['confirm_password'] = '1234567';
		$result = $this->User->changePassword($data);
		$this->assertFalse($result);
	}
	function testChangePasswordAndLogin()
	{
		$data['User']['id'] = '1';
		$data['User']['password'] = 'newpassword1234';
		$data['User']['confirm_password'] = 'newpassword1234';
		$result = $this->User->changePassword($data);
		$this->assertTrue($result);
		$credentials['username'] = 'sampleuser121';
		$credentials['password'] = 'newpassword1234';
		$user = $this->User->authsomeLogin('credentials',$credentials);
		$this->assertTrue($user);
	}
	function testForgotPassword()
	{
		$result = $this->User->forgotPassword('fake@mysite.com');
		$this->assertTrue($result);
		$this->assertEqual($this->User->lastResetPassword['id'],1);
		$this->assertEqual($this->User->lastResetPassword['password'],'e10adc3949ba59abbe56e057f20f883e');
	}
	function testForgotPasswordAndLogin()
	{
		$result = $this->User->forgotPassword('fake@mysite.com');
		$this->assertTrue($result);
		$this->assertEqual($this->User->lastResetPassword['id'],1);
		$this->assertEqual($this->User->lastResetPassword['password'],'e10adc3949ba59abbe56e057f20f883e');

		$credentials['username'] = 'sampleuser121';
		$credentials['password'] = '123456';
		$user = $this->User->authsomeLogin('credentials',$credentials);
		$this->assertTrue($user);
	}
	
	function testActivateAccountAndLogin()
	{
		$data['User']['id'] = null;
		$data['User']['username'] = 'johnsmith1234';
		$data['User']['password'] = '123456';
		$data['User']['confirm_password'] = '123456';
		$data['User']['email'] = 'jed@bodegasale.com';
		$data['User']['first_name'] = 'John';
		$data['User']['last_name'] = 'Smith';
		$data['User']['user_group_id'] = '2';

		$result = $this->User->save($data);
		$this->assertTrue($result);

		$id = $this->User->getLastInsertID();
		$activate_key = $this->User->getActivationKey($data['User']['password']);
		
		$getData = array('ident'=>$id,'activate'=>$activate_key);
		$this->assertTrue($this->User->activateAccount($getData));

		$user = $this->User->read(null,$id);
		
		$credentials['username'] = 'sampleuser121';
		$credentials['password'] = '123456';
		$user = $this->User->authsomeLogin('credentials',$credentials);
		$this->assertTrue($user);
		$this->assertEqual($user['User']['username'],'sampleuser121');
	}
	function testNewRegistration()
	{
		$data['User']['id'] = null;
		$data['User']['username'] = 'johnsmith1234';
		$data['User']['password'] = '123456';
		$data['User']['confirm_password'] = '123456';
		$data['User']['email'] = 'jed@bodegasale.com';
		$data['User']['first_name'] = 'John';
		$data['User']['last_name'] = 'Smith';
		$data['User']['user_group_id'] = '2';

		$result = $this->User->save($data);
		$this->assertTrue($result);

		$record = $this->User->find("User.username = 'johnsmith1234'");
		$this->assertTrue($record);
		$this->assertEqual($record['User']['username'],'johnsmith1234');
		$this->assertEqual($record['User']['first_name'],'John');
	}
	
	function testLogin()
	{
		$credentials['username'] = 'sampleuser121';
		$credentials['password'] = '123456';
		$user = $this->User->authsomeLogin('credentials',$credentials);
		$this->assertTrue($user);
		$this->assertEqual($user['User']['username'],'sampleuser121');
	}

	function testLoginFailed()
	{
		$credentials['username'] = 'sampleuser121';
		$credentials['password'] = '1234';
		$user = $this->User->authsomeLogin('credentials',$credentials);
		$this->assertFalse($user);
	}
	
	function testFailedRegistration()
	{
		$data['User']['id'] = null;
		$data['User']['username'] = 'johnsmith1234';
		$data['User']['password'] = '';
		$data['User']['confirm_password'] = '';
		$data['User']['email'] = 'jed@bodegasale.com';
		$data['User']['first_name'] = 'John';
		$data['User']['last_name'] = 'Smith';
		$data['User']['user_group_id'] = '2';

		$result = $this->User->save($data);
		$this->assertFalse($result);
	}
	
	function testNewUserErrorPasswordInvalids()
	{
		$data['User']['id'] = null;
		$data['User']['username'] = 'johnsmith1234';
		$data['User']['password'] = '';
		$data['User']['confirm_password'] = '';
		$data['User']['email'] = 'jed@bodegasale.com';
		$data['User']['first_name'] = 'John';
		$data['User']['last_name'] = 'Smith';

		$result = $this->User->save($data);
		$this->assertFalse($result);

		$data['User']['password'] = '1234';
		$data['User']['confirm_password'] = '123456';
		$result = $this->User->save($data);
		$this->assertFalse($result);
	}

	function testNewUserErrorUsernameInvalids()
	{
		//blank username
		$data['User']['id'] = null;
		$data['User']['username'] = '';
		$data['User']['password'] = '12345678';
		$data['User']['confirm_password'] = '12345678';
		$data['User']['email'] = 'jed@bodegasale.com';
		$data['User']['first_name'] = 'John';
		$data['User']['last_name'] = 'Smith';

		$result = $this->User->save($data);
		$this->assertFalse($result);

		//username with invalid characters
		$data['User']['username'] = '12#$%';
		$result = $this->User->save($data);
		$this->assertFalse($result);

		//username with short characters
		$data['User']['id'] = null;
		$data['User']['username'] = 'ab';
		$result = $this->User->save($data);
		$this->assertFalse($result);

		//username is duplicate
		$data['User']['id'] = null;
		$data['User']['username'] = 'sampleuser121';
		$result = $this->User->save($data);
		$this->assertFalse($result);
	}

	function testNewUserErrorEmailInvalids()
	{
		//blank email
		$data['User']['id'] = null;
		$data['User']['username'] = 'johnsmith1234';
		$data['User']['password'] = '12345678';
		$data['User']['confirm_password'] = '12345678';
		$data['User']['email'] = '';
		$data['User']['first_name'] = 'John';
		$data['User']['last_name'] = 'Smith';

		$result = $this->User->save($data);
		$this->assertFalse($result);

		//email with invalid format
		$data['User']['email'] = 'jed=mysite.com';
		$result = $this->User->save($data);
		$this->assertFalse($result);

		//email duplicate
		$data['User']['email'] = 'fake@mysite.com';
		$result = $this->User->save($data);
		$this->assertFalse($result);
	}
	function testActivatePasswordErrorConfirm()
	{
		$data['User']['ident'] = '1';
		$salt = Configure::read ( "Security.salt" );
		$data['User']['activate'] = md5('e10adc3949ba59abbe56e057f20f883e'.$salt);
		$data['User']['password'] = '12345678';
		$data['User']['confirm_password'] = '1234';
		$result = $this->User->activatePassword($data);
		$this->assertFalse($result);
	}
	function testActivatePasswordErrorInvalidKey()
	{
		$data['User']['ident'] = '1';
		$salt = Configure::read ( "Security.salt" );
		$data['User']['activate'] = md5('easdfasdfasdfsd883e'.$salt);
		$data['User']['password'] = '1234';
		$data['User']['confirm_password'] = '1234';
		$result = $this->User->activatePassword($data);
		$this->assertFalse($result);
	}
}
?>