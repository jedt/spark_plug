<?php
class UserGroupFixture extends CakeTestFixture
{
	var $name = 'UserGroup';
	var $import = array('model'=>'SparkPlug.UserGroup','records'=>false);
	var $records = array(
		array('id'=>'1','name'=>'Admin'),
		array('id'=>'2','name'=>'User'),
		array('id'=>'3','name'=>'Guest'),
	);
}
?>