## Description

Spark Plug Cakephp plugin is a "pulled-out" script from the flashub.com project. It uses the Authsome component and uses a very simple access control routine. [Forking](http://help.github.com/forking/) of this project is very much welcome.

Sample Ideas:

- Forum, Q&A site, Dating site, Ecommerce, Review site, Blog/Microblog Twitter clone etc..

Please visit the [Spark Plug Wiki](http://wiki.github.com/jedt/spark_plug/) for a full guide and [this page](http://wiki.github.com/jedt/spark_plug/) for support and bug reports.

## Features version 1.0

- Easy to install. This is totally subjective but is one of the main features.

- Multi User Registration/Login. This enables your project to have multi-user access. For example you want to write a forum site. This plug-in provides below:

 1. Registration form - Users have to fill-up the registration form and it will send an activation email. After activation the user's password is hashed for security.

 2. Login Form - The page to login your username and password.

 3. Remember me cookie - Thanks to the authsome component, you can just check the remember me checkbox and you will log-in to your site immediately.

 4. Change password - Users can log-in to your site change your current password.

 5. Forgot password - When your user forgot his password he can use this form to reset it.

- User dashboard section. When a user logs in it redirects you to the dashboard.

- Simple ACL. Your site's user section is protected. Visitors must login to get access to the dashboard.

- Admin User CRUD - As admin you can edit/delete users.

## Scope/Limitation

This plugin is only used for User Management. It has nothing in the dashboard but the change password page and log out. So it is very usable to anyone wants to start a new multi-user site or software.

## Minimum Requirements

- PHP 5.2
- Mysql
- Cakephp 1.3

## Installation

- Copy the spark_plug folder into the app/plugin/ directory.
- Run all the sql files in the spark_plug/config/schema/ directory.
- open your app/config/core.php and add the line below:

	`include_once(ROOT.'/app/plugins/spark_plug/config/config.php');`

- open your app/config/routes.php

	`include_once(ROOT.'/app/plugins/spark_plug/config/routes.php');`

- open the app/plugins/spark_plug/config/config.php and change according to your setup.

- Go to the login page [http://localhost/mysite/users/login](http://localhost/mysite/users/login)
 - type in username: admin
 - password: 1234

- You should see the dashboard now with a logout link.

- To test the registration form just click the Not registerd yet? Click here link.

- to override the plugin views such as the login and registration pages. Put the following in your app/view/ folder.

	`plugins/spark_plug/users/login.ctp`

	`plugins/spark_plug/users/register.ctp`

## License

The MIT License

Copyright (c) 2010 [Spark Plug Cakephp plugin](http://github.com/jedt/spark_plug)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

## Contributors

[Aquive](http://github.com/Aquive)

[jedt](http://github.com/jedt)
