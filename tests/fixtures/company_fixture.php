<?php
class CompanyFixture extends CakeTestFixture
{
	var $name = 'Company';
	var $import = array('model'=>'SparkPlug.Company','records'=>false);
	
	var $records = array(
		array('id'=>'1','user_id'=>'1')
	);
}
?>