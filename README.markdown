## Description

Spark Plug Cakephp plugin is a "pulled-out" script from the flashub.com project. It uses the Authsome component and uses a very simple access control routine. 

## Features

- Easy to install. This is totally subjective but is one of the main features.

- Multi User Registration/Login. This enables your project to have multi-user access. For example you want to write a forum site. This plug-in provides below:

 - Registration form - Users have to fill-up the registration form and it will send an activation email. After activation the user's password is hashed for security.

 - Login Form - The page to login your username and password.

 - Remember me cookie** - Thanks to the authsome component, you can just check the remember me checkbox and you will log-in to your site immediately.

 - Change password - Users can log-in to your site change your current password.

 - Forgot password - When your user forgot his password he can use this form to reset it.

- User dashboard section. When a user logs in it redirects you to the dashboard.

- Simple ACL. Your site's user section is protected. Visitors must login to get access to the dashboard.

## Scope/Limitation

This plugin is only used for User Management. It has nothing in the dashboard but the change password page and log out. So it is very usable to anyone wants to start a new multi-user site or software.

## Minimum Requirements

- PHP 5.2
- Mysql
- Cakephp 1.3

## Todo

- Open ID Registration.
- Captcha on Registration.

## Installation

- Copy the spark_plug folder into the plugin/ directory.
- Run all the sql files in the spark_plug/config/schema/ directory.
- open your app/config/core.php and add the line below:
	
	include_once(ROOT.'/app/plugins/spark_plug/config/config.php');

- open your app/config/routes.php

	include_once(ROOT.'/app/plugins/spark_plug/config/routes.php');
	
- Go to the login page [http://localhost/mysite/users/login]http://localhost/mysite/users/login
 - type in username: admin 
 - password: 1234

- You should see the dashboard now with a logout link.

- To test the registration form just click the Not registerd yet? Click here link.
