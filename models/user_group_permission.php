<?php
class UserGroupPermission extends SparkPlugAppModel
{
	var $name = 'UserGroupPermission';
    var $belongsTo = array('SparkPlug.UserGroup');
}
?>
