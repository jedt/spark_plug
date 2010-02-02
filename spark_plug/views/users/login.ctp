<h2>Login your username and password</h2>
<?=$form->create('User', array('action' => 'login')); ?>
<?=$form->input("username")	?>
<?=$form->input("password",array("type"=>"password")) ?>
<?=$form->input('remember', array('label' => "Remember me for 2 weeks",'type' => 'checkbox'))?>
<?=$form->submit('Login'); ?>
<?=$form->end(); ?>
<p>Not registered yet? <?php echo $html->link("Click Here","/users/register") ?></p>
<p><?php echo $html->link("Forgot your password?","/users/forgotPassword") ?></p>
