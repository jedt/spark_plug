<?php
class UserGroupPermission extends SparkPlugAppModel
{
	var $name = 'UserGroupPermission';
	var $belongsTo = array('SparkPlug.UserGroup');

	//TODO: create validation criteria and show errors
	var $validate = array(
        'user_group_id' => 'notEmpty',
		'controller' => 'notEmpty',
		'action' => 'notEmpty'
    );

	function afterSave(){
		$this->__invalidateRulesCache();
	}
	
	function afterDelete(){
		$this->__invalidateRulesCache();		
	}

	/**
	 * Deletes all the rules cache keys
	 * @return unknown_type
	 */
	function __invalidateRulesCache(){
		// clear rule cache
		$cacheKeys = array();
		App::import('Model', 'UserGroup');
		$allRules = $this->UserGroup->find('all', array('recursive' => 0));
		foreach($allRules as $r){
			$cacheKeys[] = 'rules_for_group_'.$r['UserGroup']['id'].'_';
			$cacheKeys[] = 'rules_for_group_'.$r['UserGroup']['id'].'_1';
		}
			
		foreach ($cacheKeys as $k){
			Cache::delete($k, 'SparkPlug');
		}

	}
}
?>