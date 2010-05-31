<?php
Router::connect('/users/:action/*', array('plugin' => 'spark_plug', 'controller' => 'users'));
Router::connect('/dashboard', array('plugin' => 'spark_plug', 'controller' => 'users', 'action'=>'dashboard'));
Router::connect('/users/dashboard', array('plugin' => 'spark_plug', 'controller' => 'users', 'action'=>'dashboard'));
Router::connect('/user_groups/:action', array('plugin' => 'spark_plug', 'controller'=>'user_groups'));
Router::connect('/user_group_permissions/:action/*', array('plugin' => 'spark_plug', 'controller'=>'user_group_permissions'));
// Router::connect('/init', array('plugin' => 'spark_plug', 'controller' => 'user_groups','action'=>'build_acl'));
Router::connect('/register', array('plugin' => 'spark_plug', 'controller' => 'users', 'action' => 'register'));
Router::connect('/users/register', array('plugin' => 'spark_plug', 'controller' => 'users', 'action' => 'register'));

Router::connect('/login', array('plugin' => 'spark_plug', 'controller' => 'users', 'action' => 'login'));
Router::connect('/users/login', array('plugin' => 'spark_plug', 'controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('plugin' => 'spark_plug', 'controller' => 'users', 'action' => 'logout'));
Router::connect('/users/logout', array('plugin' => 'spark_plug', 'controller' => 'users', 'action' => 'logout'));

Router::connect('/users/forgotPassword', array('plugin' => 'spark_plug', 'controller' => 'users', 'action' => 'forgotPassword'));

Router::connect('/errors/unauthorized', array('plugin' => 'spark_plug', 'controller' => 'errors', 'action' => 'unauthorized'));

?>