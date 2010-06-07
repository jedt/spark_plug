<?php
class UserGroup extends SparkPlugAppModel
{

	var $name = 'UserGroup';
	var $hasMany = array('SparkPlug.User','SparkPlug.UserGroupPermission');

	/**
	 * Checks if a user group has access to a url
	 * @param $userGroupID
	 * @param $access
	 * @param $includeGuestPermission
	 * @return unknown_type
	 */
	function isUserGroupAccess($userGroupID,$access,$includeGuestPermission=true)
	{
		if (empty($access) || $access=='/' || substr($access,0,4)=='css/'){
		return true;
		}

		$permissions = $this->getPermissions($userGroupID,$includeGuestPermission);

		//$paths = explode('/',$access);
		$actionRequested = Router::parse($access);
		//debug($permissions);
		//debug($actionRequested);
		//$this->log($permissions);
		//$this->log($actionRequested);

		foreach($permissions as $perm){
			if ($perm['plugin'] == $actionRequested['plugin'] &&
			strtoupper($perm['controller']) == strtoupper($actionRequested['controller']) &&
			($perm['action'] == '*' || strtoupper($perm['action']) == strtoupper($actionRequested['action']))){
				// authorized
				//$this->log("SparkPlug: authorized $access for group id $userGroupID");
				//debug($perm, true);
				//die("SparkPlug: authorized $access for group id $userGroupID");
				return true;
			}
		}
		// not authorized
		//$this->log("SparkPlug: unauthorized $access for group id $userGroupID");
		//die("SparkPlug: authorized $access for group id $userGroupID");
		
		return false;
	}
	function isGuestAccess($access)
	{
		return $this->isUserGroupAccess(3, $access, false);
	}


	/**
	 * Returns an array of permissions for the $userGroupID, it includes the Guest group if $includeGuestPermission
	 *
	 * @param $userGroupID
	 * @param $includeGuestPermission
	 * @return array of permissions. permissions = array(array('plugin', 'controller', 'action'));
	 */
	function getPermissions($userGroupID=3,$includeGuestPermission=false)
	{
		//get public controller actions
		$permissions = array();

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
			$permissions[] = array('plugin' => $action['UserGroupPermission']['plugin'], 'controller' => $action['UserGroupPermission']['controller'], 'action' => $action['UserGroupPermission']['action']);
		}
		return $permissions;
	}
}
?>