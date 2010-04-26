<?php
App::import('Vendor', 'SparkPlug.phpmailer', array('file' => 'class.phpmailer.php'));
class MembershipBehavior extends ModelBehavior
{
	var $settings = array();
	var $uploader = null;
	function setup(&$Model, $settings)
	{
		if (!isset($this->settings[$Model->alias]))
		{
			$this->settings[$Model->alias] = array(
				'option1_key' => 'option1_default_value'
			);
		}
		$this->settings[$Model->alias] = array_merge(
			$this->settings[$Model->alias], (array)$settings);
	}

	function getActivationKey(&$Model,$password)
	{
		$salt = Configure::read ( "Security.salt" );
		return md5(md5($password).$salt);
	}
	function sendRegistrationEmail(&$Model)
	{
		$mail = new phpmailer();
		$mail->AddAddress($Model->data['User']['email'],$Model->data['User']['username']);
		$mail->Subject = $Model->getEmailSubjectNew();
		$message = $Model->getEmailBodyNew();
		
		$activate_key = $this->getActivationKey($Model,$Model->data['User']['password']);

		$id = $Model->getLastInsertID();
		$Model->updateAll(array('password'=>"'".md5($Model->data['User']['password'])."'"),'User.id = '.$id);

		$id = $Model->getLastInsertID();
		
		$link = Router::url("/users/login?ident=$id&activate=$activate_key",true);

		$message = str_replace('{$link}', $link , $message);
		
		$mail->Body = $message;

		$mail->FromName = Configure::read('SparkPlug.administrator.from_name');
		$mail->From = Configure::read('SparkPlug.administrator.email');

		$Model->lastRegisteredUser = array('id'=>$id,'activate_key'=>$activate_key);

		if ($Model->useDbConfig!='test_suite')
			$mail->Send();
	}

	function activateAccount(&$Model,$getVars)
	{
		$id = $getVars["ident"];
		$activateKey = $getVars["activate"];

		$user = $Model->read(null,$id);
		if (!empty($user))
		{
			$active = $user['User']['active'];
			if (empty($active) || $active=='N')
			{
				$password = $user['User']['password'];
				$salt = Configure::read ( "Security.salt" );
				$theKey = md5 ( $password . $salt );
				if ($activateKey==$theKey)
				{
					//set active and hash password
					$Model->updateAll(array('active'=>'1'),'User.id = '.$id);
					$output = array('success'=>true,'message'=>'Thank you. Your account is now active.');
					return $output;
				}
			}
			else
			{
				//user is already activated.
				return true;
			}
		}
		else
		{
			//activation link doesn't exist;
			return false;
		}

	}
	function forgotPassword(&$Model,$email)
	{
		$user = $Model->find("User.email = '".$email."'");
		if ($user)
		{
			$id = $user['User']['id'];
			
			$mail = new phpmailer();
			$mail->AddAddress($user['User']['email'],$user['User']['username']);
			
			$mail->FromName = 'Site Administrator';
			$mail->From = 'admin@bodegasale.com';
			$mail->Subject = 'Password Reset';

			$password = $user['User']['password'];

			$salt = Configure::read ( "Security.salt" );
			$activate_key = md5($password.$salt );

			$link = Router::url ( "/users/activate_password?ident=$id&activate=$activate_key", true );
		
			$mail->Body = "Dear ".$user['User']['username'].",

Kindly click the link below:
".$link."
	
Then set your password.

Regards,
Site Admin";
			if ($Model->useDbConfig!='test_suite')
				$mail->Send();

			$Model->lastResetPassword = array('id'=>$id,'password'=>$password);
			
			return true;
		}
		else
		{
			return false;
		}
	}
	function changePassword($Model,$data)
	{
		$Model->set($data);
		$valid = $Model->validates();
		if ($valid)
		{
			$Model->updateAll(array('password'=>"'".md5($data['User']['password'])."'"),"User.id = '".$data['User']['id']."'");
			return true;
		}
		else
		{
			return false;
		}
	}
	function activatePassword($Model,$data)
	{
		$user = $Model->read(null,$data['User']['ident']);
		if ($user)
		{
			$password = $user['User']['password'];
			$salt = Configure::read ( "Security.salt" );
			$thekey = md5($password.$salt);
			
			if ($thekey==$data['User']['activate'])
			{
				$user['User']['password'] = $data['User']['password'];
				$user['User']['confirm_password'] = $data['User']['confirm_password'];
				if ($Model->save($user))
				{
					$Model->updateAll(array('password'=>"'".md5($user['User']['password'])."'"),"User.id = '".$data['User']['ident']."'");
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>