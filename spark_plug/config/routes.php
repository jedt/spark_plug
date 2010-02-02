<?php
Router::connect('/users/:action', array('plugin' => 'spark_plug', 'controller' => 'users'));
Router::connect('/dashboard', array('plugin' => 'spark_plug', 'controller' => 'users', 'action'=>'dashboard'));
Router::connect('/user_groups/:action', array('plugin' => 'spark_plug', 'controller'=>'user_groups'));
Router::connect('/init', array('plugin' => 'spark_plug', 'controller' => 'user_groups','action'=>'build_acl'));
?>