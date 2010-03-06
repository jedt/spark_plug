<?php
class UsersController extends SparkPlugAppController {

	var $name = 'Users';

	var $layout_settings = array("columns"=>"1");
	var $uses = array('SparkPlug.User');

    function index()
    {
        $this->layout = Configure::read('dashboard_layout');
        $users = $this->paginate('User');
        $this->set('users',$users);
    }

    function edit($id=null)
    {
        $this->layout = Configure::read('dashboard_layout');
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
        $this->layout = Configure::read('dashboard_layout');
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
		$this->layout = Configure::read('dashboard_layout');
	}
	function register()
	{
		$user = $this->Authsome->get();
		if ($user)
		{
			$this->redirect("/users/dashboard");
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
		$this->layout = Configure::read('dashboard_layout');
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
        $user = $this->User->read(null,$id);
        $this->Session->write("User",$user);
        $this->Session->write("User.id",$user["User"]["id"]);
        $this->Session->write("UserGroup.id",$user["UserGroup"]["id"]);
        $this->Session->write("UserGroup.name",$user["UserGroup"]["name"]);
        $this->Session->write('Company.id',$user['Company']['id']);
        $this->redirect('/users/dashboard');
    }
	function login()
	{
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

			$this->redirect('/users/dashboard');
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