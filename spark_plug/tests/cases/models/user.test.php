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

	function testNewRegistration()
	{
		$data['User']['id'] = null;
		$data['User']['username'] = 'johnsmith1234';
		$data['User']['password'] = '123456';
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

	
}
?>