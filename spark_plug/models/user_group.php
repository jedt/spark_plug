<?php
class UserGroup extends SparkPlugAppModel
{

	var $name = 'UserGroup';
	var $hasMany = array('SparkPlug.User','SparkPlug.UserGroupPermission');

	function isGuestAccess($access)
	{
		if (empty($access) || $access=='/')
			return true;
		
		$permissions = $this->getPermissions(3);
		
		if (!in_array(ucwords($access), $permissions))
		{
			//check if permission is a wildcard
			foreach ($permissions as $permission)
			{
				//must match Websites/* == Websites/settings
				if (strpos($permission,'/*') !== false)
				{
					$accessController = explode('/',$access);

					if (rtrim($permission,'/*')==$accessController[0])
					{
						return true;
					}
				}
			}
			return false;
		}

		return true;
	}
	function getPermissions($id=3)
	{
		//get public controller actions
		$permissions[] = '/'; 
		
		$actions = $this->UserGroupPermission->find('all',array('conditions'=>'UserGroupPermission.user_group_id = '.$id));
		foreach ($actions as $action)
		{
			$permissions[] = $action['UserGroupPermission']['controller'].'/'.$action['UserGroupPermission']['action'];
		}
		return $permissions;
	}
}
?>
