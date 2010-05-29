<?php
class UserGroup extends SparkPlugAppModel
{

	var $name = 'UserGroup';
	var $hasMany = array('SparkPlug.User','SparkPlug.UserGroupPermission');

	function isUserGroupAccess($userGroupID,$access,$includeGuestPermission=true)
	{
		if (empty($access) || $access=='/' || substr($access,0,4)=='css/')
		return true;

		$permissions = $this->getPermissions($userGroupID,$includeGuestPermission);

		$paths = explode('/',$access);
		if (count($paths) > 2)
		{
			//strip the arguments
			$access = $paths[0].'/'.$paths[1];
		}

		if (!in_array(ucwords($access), $permissions))
		{
			//check if permission is a wildcard
			foreach ($permissions as $permission)
			{
				//must match Websites/* == Websites/settings
				if (strpos($permission,'/*') !== false)
				{
					$accessController = explode('/',$access);

					if (rtrim($permission,'/*')==Inflector::camelize($accessController[0]))
					{
						return true;
					}
				}
			}

			return false;
		}

		return true;
	}
	function isGuestAccess($access)
	{
		return $this->isUserGroupAccess(3, $access, false);
	}
	function getPermissions($userGroupID=3,$includeGuestPermission=false)
	{
		//get public controller actions
		$permissions[] = '/';

		// using the cake cache to store rules
		$cacheKey = 'rules_for_group_'.$userGroupID.'_'.$includeGuestPermission;
		$actions = Cache::read($cacheKey, 'SparkPlug' );
		if ($actions === false) {

			if ($includeGuestPermission){
				$actions = $this->UserGroupPermission->find('all',array('conditions'=>'(UserGroupPermission.user_group_id = '.$userGroupID.' OR UserGroupPermission.user_group_id = 3) AND UserGroupPermission.allowed = 1'));
			}
			else {
				$actions = $this->UserGroupPermission->find('all',array('conditions'=>'UserGroupPermission.user_group_id = '.$userGroupID.' AND UserGroupPermission.allowed = 1'));
			}
			Cache::write($cacheKey, $actions, 'SparkPlug');
		}
		// else the content is retrieved from the cache
		
		foreach ($actions as $action)
		{
			$permissions[] = $action['UserGroupPermission']['controller'].'/'.$action['UserGroupPermission']['action'];
		}
		return $permissions;
	}
}
?>
