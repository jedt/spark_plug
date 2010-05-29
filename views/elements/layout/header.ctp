<div id="header">
	<div id="topnav">

		<span>
		<?php echo $html->link($trans->__('Login'), '/users/login'); ?> | 
		<?php echo $html->link($trans->__('Register'), '/users/register'); ?> | 
		</span>
	</div>
	<h1><?php echo $trans->__('User Management'); ?></h1>
	</div>
<!-- begin: main navigation #nav -->
<div id="nav"> <a id="navigation" name="navigation"></a>
	<!-- skiplink anchor: navigation -->
	<div id="nav_main">
		<ul>
			<li id="current">
				<?php echo $html->link($trans->__('Home'), '/'); ?> | 
			</li>
		</ul>
	</div>
</div>