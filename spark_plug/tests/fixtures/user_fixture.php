<?php
class UserFixture extends CakeTestFixture
{
	var $name = 'User';
	var $import = array('model'=>'SparkPlug.User','records'=>false);
	var $records = array(
		array(
			'id'=>1,
			'user_group_id'=>'2',
			'username'=>'sampleuser121',
			'password'=>'e10adc3949ba59abbe56e057f20f883e',
			'first_name'=>'John',
			'last_name'=>'Doe',
			'email'=>'fake@mysite.com',
			'active'=>1),
		array('id'=>101,
			'user_group_id'=>'2',
			'username'=>'deletableuser',
			'password'=>'e10adc3949ba59abbe56e057f20f883e',
			'first_name'=>'Peter',
			'last_name'=>'Doe',
			'email'=>'fake2@mysite.com',
			'active'=>1)
	);
}
?>