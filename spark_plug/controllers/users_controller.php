<?php
class UsersController extends SparkPlugAppController {

	var $name = 'Users';
	
	var $layout_settings = array("columns"=>"1");
	var $uses = array('SparkPlug.User');

	function logout()
	{
		$this->Authsome->logout();
		$this->Session->setFlash('You are now logged out.');
		$this->redirect('/users/login');

	}
	function dashboard()
	{
		$this->layout = Configure::read('dashboard_layout');
	}
	function register()
	{
		$user = $this->Authsome->get();
		if ($user)
		{
			$this->redirect("/dashboard");
		}
		else
		{
			$this->layout = Configure::read('front_end_layout');

			if ($this->data)
			{
				if ($this->User->save($this->data))
				{
					$this->flash("Thank you for joining. Please check your email for instructions.","login");
				} else {
					$this->data['User']['password'] = null;
					$this->data['User']['confirm_password'] = null;
				}
			}
		}
	}
	function activate_password()
	{
		$this->layout = Configure::read('front_end_layout');
		if ($this->data)
		{
			if (!empty($this->data['User']['ident']) && !empty($this->data['User']['activate']))
			{
				$this->set('ident',$this->data['User']['ident']);
				$this->set('activate',$this->data['User']['activate']);

				$return = $this->User->activatePassword($this->data);
				if ($return)
				{
					$this->flash('New password is saved.','login','success');
				}
				else
				{
					$this->flashError('Sorry password could not be saved.','activate_password');
				}
			}
		}
		else
		{
			if (isset($_GET['ident']) && isset($_GET['activate']))
			{
				$this->set('ident',$_GET['ident']);
				$this->set('activate',$_GET['activate']);
			}
		}
	}
	function change_password()
	{
		$this->layout = Configure::read('dashboard_layout');
		if ($this->data)
		{
			if ($this->User->changePassword($this->data))
			{
				$this->flash('Password has changed.','change_password','success');
			}
		}
		else
		{
			$userID = $this->Session->read('User.id');
			$this->data = $this->User->read(null,$userID);
		}
	}
	
	function login()
	{
        if (empty($this->data)) {
            return;
        }

        $user = Authsome::login($this->data['User']);

        if (!$user) {
            $this->Session->setFlash('Unknown user or wrong password');
            return;
        }

		$remember = (!empty($this->data['User']['remember']));
		if ($remember)
		{
			Authsome::persist('2 weeks');
		}

		$this->Session->write("User",$user);
		$this->Session->write("User.id",$user["User"]["id"]);
		$this->Session->write("UserGroup.id",$user["UserGroup"]["id"]);
		$this->Session->write("UserGroup.name",$user["UserGroup"]["name"]);
		$this->Session->write('Company.id',$user['Company']['id']);
		
		$this->redirect('/dashboard');
    }

	function _login()
	{
		$this->layout = Configure::read('front_end_layout');
		$guest = Authsome::get();
debug($guest);
die();
		
		if (isset($_GET["ident"]))
		{
			if ($this->User->activateAccount($_GET))
			{
				$this->flash("Thank you. Your account is now active.","login");
			} else {
				$this->flash("Sorry. There were problems in your account activation.","login");
			}
		} else {
			if (isset($user['success']))
			{
				$user = $this->User->read(null,$user["User"]["id"]);
				$this->Session->write("User",$user);
				$this->Session->write("User.id",$user["User"]["id"]);
				$this->Session->write("UserGroup.id",$user["UserGroup"]["id"]);
				$this->Session->write("UserGroup.name",$user["UserGroup"]["name"]);
				$this->Session->write('Company.id',$user['Company']['id']);
				$this->redirect("/dashboard");
			}
			elseif (isset($user['error']))
			{
				$this->flash($user['error']['message'],'login');
			}
		}
	}

	function forgotPassword()
	{
		$this->layout = Configure::read('front_end_layout');
		if ($this->data)
		{
			$email = $this->data["User"]["email"];
			if ($this->User->forgotPassword($email))
			{
				$this->flash("Please check your email.","login",'success');
			} else {
				$this->flash("Your email is invalid or not registered.","login",'error');
			}
		}
	}

	function beforeFilter()
	{
		
		parent::beforeFilter();
		
		$pageRedirect = $this->Session->read('permission_error_redirect');
		$this->Session->delete('permission_error_redirect');
		
		if (empty($pageRedirect))
		{
			if (!$this->Authsome->get('id'))
			{
				//anonymous?
				$actionUrl = $this->params['url']['url'];
				$permissions = $this->User->UserGroup->getPermissions();
				if (!in_array(ucwords($actionUrl), $permissions))
				{
					$this->Session->write('permission_error_redirect','/users/login');
					$this->Session->setFlash('Sorry, You don\'t have permission to view this page.');
					$this->redirect('/users/login');
				}
			}
		}
	}
}
?>