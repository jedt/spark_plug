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
	function testUserGroupNoAccess()
	{
		$this->assertFalse($this->UserGroup->isGuestAccess('Websites/add'));
	}
	function testUserGroupWildCardAccess()
	{
		$this->assertTrue($this->UserGroup->isUserGroupAccess(2,'Pages/add'));
	}
	function testWildCardGuestAccess()
	{
		$this->assertTrue($this->UserGroup->isGuestAccess('Pages/add'));
	}
	function testPermissionWildCardAddWildcard()
	{
		$newPermission = array('UserGroupPermission'=>
										array(
											'user_group_id'=>'2',
											'controller'=>'Posts',
											'action'=>'*'
										));

		$this->assertTrue($this->UserGroup->UserGroupPermission->save($newPermission));


		$userPermissions = $this->UserGroup->getPermissions(2);

		$this->assertTrue($userPermissions);
		$this->assertEqual($userPermissions[0],'/');
		$this->assertEqual($userPermissions[1],'Websites/*');
		$this->assertEqual($userPermissions[2],'Pages/*');
		$this->assertEqual($userPermissions[3],'Posts/*');
	}
	function testPermissionWildCardAddSingleAction()
	{
		$newPermission = array('UserGroupPermission'=>
										array(
											'user_group_id'=>'2',
											'controller'=>'Posts',
											'action'=>'add'
										));

		$this->assertTrue($this->UserGroup->UserGroupPermission->save($newPermission));


		$userPermissions = $this->UserGroup->getPermissions(2);

		$this->assertTrue($userPermissions);
		$this->assertEqual($userPermissions[0],'/');
		$this->assertEqual($userPermissions[1],'Websites/*');
		$this->assertEqual($userPermissions[2],'Pages/*');
		$this->assertEqual($userPermissions[3],'Posts/add');
	}
	function testPermissionWildCardDefault()
	{
		//must test functionality of access websites/*
		$userPermissions = $this->UserGroup->getPermissions(2);
		$this->assertTrue($userPermissions);
		$this->assertEqual($userPermissions[0],'/');
		$this->assertEqual($userPermissions[1],'Websites/*');
	}
	function testPermission()
	{
		$this->assertTrue($this->UserGroup->isGuestAccess('users/login'));
		$this->assertTrue($this->UserGroup->isGuestAccess('Users/register'));
		$this->assertTrue($this->UserGroup->isGuestAccess('Users/logout'));
	}

}
?>