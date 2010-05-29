<?php
class UserGroupPermission extends SparkPlugAppModel
{
	var $name = 'UserGroupPermission';
	var $belongsTo = array('SparkPlug.UserGroup');

	//TODO: terminar estas 2 y upload !
	// aftersave - crear entrada de cache para reglas del grupo
	// afterdelete borrar entrada de cache para el grupo

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