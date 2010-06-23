<?php
$javascript->link('wufoo.js', false);
//$html->css('/css-basic/wufoo/structure', null, null, false);
$html->css('/css-basic/wufoo/form', null, null, false);
$html->css('/css-basic/wufoo/theme', null, null, false);

$html->css('framework.css', null, null, false);

?>
<h2>Login your username and password</h2>
<?=$form->create('User', array('action' => 'login')); ?>
<ul>
	<li><?=$form->input("username")	?></li>
	<li><?=$form->input("password",array("type"=>"password")) ?></li>
	<li><?=$form->input('remember', array('label' => "Remember me for 2 weeks",'type' => 'checkbox'))?></li>
	<li><?=$form->submit('Login'); ?></li>
</ul>
<?=$form->end(); ?>
<?php if (Configure::read('SparkPlug.open_registration')): ?>
	<p>Not registered yet? <?php echo $html->link("Click Here","/users/register") ?></p>
<?php endif ?>
<p><?php echo $html->link("Forgot your password?","/users/forgotPassword") ?></p>
