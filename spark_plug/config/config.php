<?php

Configure::write('Project',array('name'=>'Spark Plug Cakephp Plugin'));


Configure::write('UserPermissions',array(
				'controllers/Posts/index',
				'controllers/Posts/edit',
				'controllers/Websites'
));

Configure::write('rootURL','localhost/sparky');
Configure::write('projectName','Spark Plug Cakephp Plugin');
Configure::write('logged-in-menu','logged_in_menu');
Configure::write('front_end_layout','default');
Configure::write('dashboard_layout','default');

?>