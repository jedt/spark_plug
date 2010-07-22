<?php

class UsersController extends SparkPlugAppController {

	var $name = 'Users';

	var $layout_settings = array("columns"=>"1");
	var $uses = array('SparkPlug.User');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->layout = Configure::read('dashboard_layout');
	}

	function index()
	{
		$users = $this->paginate('User');
		$this->set('users',$users);
	}

	function edit($id=null)
	{
		$userGroups = $this->User->UserGroup->find('list');
		$this->set('userGroups',$userGroups);

		if (!empty($this->data))
		{
			if ($this->User->save($this->data))
			{
				$this->Session->setFlash('User is saved.');
				$this->redirect('/users/index');
			}
		}
		else
		{
			$this->data = $this->User->read(null,$id);
		}
	}

	function delete($id)
	{
		$this->User->delete($id);
		$this->Session->setFlash('User was deleted.');
		$this->redirect('/users/index');
	}

	function logout()
	{
		$this->Authsome->logout();
		$this->Session->setFlash('You are now logged out.');
		$this->redirect('/users/login');
	}
	function dashboard()
	{
	}

	function register()
	{
		$this->layout = Configure::read('front_end_layout');
		$user = $this->Authsome->get();
		if ($user)
		{
			$this->redirect(Configure::read('SparkPlug.loginRedirect'));
		}
		else
		{
			if(!Configure::read('SparkPlug.open_registration')) {
				$this->Session->setFlash('Please contact an administrator to setup an account');
				$this->redirect('/users/login');
			}
			$this->layout = Configure::read('front_end_layout');

			if ($this->data)
			{
				if ($this->User->save($this->data))
				{
					$registerAutoLogin = Configure::read('SparkPlug.registerAutoLogin');
					if($registerAutoLogin) {
						$user = $this->User->read(null,$this->User->id);
						$this->Session->write("User",$user);
						$this->Session->write("User.id",$user["User"]["id"]);
						$this->Session->write("UserGroup.id",$user["UserGroup"]["id"]);
						$this->Session->write("UserGroup.name",$user["UserGroup"]["name"]);
						$this->Session->write('Company.id',$user['Company']['id']);
						$this->tinymce_filemanager_init();
					}

					$registerRedirect = Configure::read('SparkPlug.registerRedirect');
					if(!empty($registerRedirect)) {
						$this->redirect($registerRedirect);
					}
					$this->flash("Thank you for joining. Please check your email for instructions.","login");
				} else {
					$this->data['User']['password'] = null;
					$this->data['User']['confirm_password'] = null;
				}
			} else {
				$this->data['User']['optin'] = Configure::read('SparkPlug.register_defaults.optin');
				$this->data['User']['agreement'] = Configure::read('SparkPlug.register_defaults.agreement');
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
					$this->flash('New password is saved.',Configure::read('httpRootUrl').'/users/login');
				}
				else
				{
					$this->flash('Sorry password could not be saved. Please check your email and click the password reset link again.',Configure::read('httpRootUrl').'/users/login');
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
		if ($this->data)
		{
			if ($this->User->changePassword($this->data))
			{
				$this->flash('Password has changed.',Configure::read('httpRootUrl').'/users/dashboard');
			}
		}
		else
		{
			$userID = $this->Session->read('User.id');
			$this->data = $this->User->read(null,$userID);
			$this->data['User']['password']='';
		}
	}
	function login_as_user($id)
	{
		if(Configure::read('SparkPlug.allow.login_as_user')==false) return;
		$user = $this->User->read(null,$id);
		$this->Session->write("User",$user);
		$this->Session->write("User.id",$user["User"]["id"]);
		$this->Session->write("UserGroup.id",$user["UserGroup"]["id"]);
		$this->Session->write("UserGroup.name",$user["UserGroup"]["name"]);
		$this->Session->write('Company.id',$user['Company']['id']);
		$this->tinymce_filemanager_init();
		$this->redirect('/users/dashboard');
	}
	
	function tinymce_filemanager_init() {
		$_SESSION['isLoggedIn'] = true;
		//$_SESSION['filemanager.filesystem.path'] = MEDIA.'files';
		//$_SESSION['filemanager.filesystem.rootpath'] = MEDIA.'files';
	}


	function login()
	{
		$this->layout = Configure::read('front_end_layout');
		
		if (isset($_GET["ident"]))
		{
			if ($this->User->activateAccount($_GET))
			{
				$this->flash("Thank you. Your account is now active.",Configure::read('httpRootUrl').'/users/login');
			} else {
				$this->flash("Sorry. There were problems in your account activation.",Configure::read('httpRootUrl').'/users/login');
			}
		}
		else
		{
			if (empty($this->data)) {
				return;
			}
			
/*			if (!empty(Authsome::get()){
				$this->Session->setFlash('Already logged in, logout first');
				return;
			}
*/
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

			// let's redirect to the page that triggered the login attempt
			$originAfterLogin = $this->Session->read('SparkPlug.OriginAfterLogin');
			$this->tinymce_filemanager_init();
			if (Configure::read('SparkPlug.redirectOriginAfterLogin') && $originAfterLogin != null) {
				$this->redirect($originAfterLogin);
			} else {
				// redirect to default location
				$this->redirect(Configure::read('SparkPlug.loginRedirect'));
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
				$this->flash("Please check your email for instructions on resetting your password.","login",'success');
			} else {
				$this->flash("Your email is invalid or not registered.","login",'error');
			}
		}
	}
}
?>