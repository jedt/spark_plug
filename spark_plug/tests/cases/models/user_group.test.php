<?php
App::import('model','SparkPlug.UserGroup');

class UserGroupTest extends CakeTestCase
{
	var $fixtures = array('plugin.spark_plug.user',
							'plugin.spark_plug.login_token',
							'plugin.spark_plug.user_group',
							'plugin.spark_plug.user_group_permission',
							'plugin.spark_plug.company');
	function startTest()
	{
		$this->UserGroup =& ClassRegistry::init('UserGroup');
	}

	function testPermission()
	{
		$this->assertTrue($this->UserGroup->isGuestAccess('users/login'));
		$this->assertTrue($this->UserGroup->isGuestAccess('Users/register'));
		$this->assertTrue($this->UserGroup->isGuestAccess('Users/logout'));
	}

	function testPermissionWildCard()
	{
		//must test functionality of access websites/*
	}
}
?>