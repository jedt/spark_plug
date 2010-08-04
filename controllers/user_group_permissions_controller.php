<?php
class UserGroupPermissionsController extends SparkPlugAppController {
	var $name = 'UserGroupPermissions';
	var $uses = array('SparkPlug.UserGroupPermission','SparkPlug.UserGroup');

	function add()
	{
		$this->layout = Configure::read('dashboard_layout');
		$userGroups = $this->UserGroup->find('list');
		$this->set('userGroups',$userGroups);
	}

	function edit($id=null)
	{
		$this->layout = Configure::read('dashboard_layout');
		$userGroups = $this->UserGroup->find('list');

		$this->set('userGroups',$userGroups);

		if (!empty($this->data))
		{
			if ($this->UserGroupPermission->save($this->data))
			{
				$this->Session->setFlash('User Group Permission is saved. Rules cache optimized.');
				$this->redirect('/user_group_permissions/index');
			}
		}
		else
		{
			$this->data = $this->UserGroupPermission->read(null,$id);
		}
	}

	function index()
	{

		$this->layout = Configure::read('dashboard_layout');

		//check for filter plugin available
		if (array_key_exists('Filter.Filter', $this->components)){
			$this->helpers[] = 'Filter.Filter';
			$this->paginate = array_merge_recursive($this->paginate, $this->Filter->paginate);
			$this->set('filterEnabled', true);
		} else {
			$this->set('filterEnabled', false);
		}

		$permissions = $this->paginate('UserGroupPermission');
		$this->set('permissions', $permissions);
	}

	/**
	 * Delete the user group permission. 
	 * @author cdburgess
	 *
	 * @param id    The User Group Permission id to be deleted.
	 */
	function delete($id = NULL) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user group permission.', true));
			$this->redirect(array('controller' => 'user_group_permissions', 'action'=>'index'));
		}
		if ($this->UserGroupPermission->delete($id)) {
			$this->Session->setFlash(__('User Group Permission deleted', true));
			$this->redirect(array('controller' => 'user_group_permissions', 'action'=>'index'));
		}
		$this->Session->setFlash(__('User Group Permission was not deleted', true));
		$this->redirect(array('controller' => 'user_group_permissions', 'action' => 'index'));
	}
}
?>