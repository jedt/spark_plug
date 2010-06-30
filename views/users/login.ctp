<div class="info">
<h2><?php echo $trans->__("Login your username and password"); ?></h2>
</div>
<?php echo $form->create('User', array('action' => 'login', 'class' => 'wufoo  page')); ?>
<ul>
<li><?php echo $form->input("username", array('label' => $trans->__('username'), 'class' => 'field text large'))	?></li>
<li><?php echo $form->input("password",array("type"=>"password", 'label' => $trans->__('password'), 'class' => 'field text large')) ?></li>
<li><?php echo $form->input('remember', array('type' => 'checkbox', 'label' => false, 'div' => false)); 
		echo $form->label('User.remember', $trans->__('Remember me for 2 weeks'), array('class' => 'field checkbox')); ?>
</li>
<li><?php echo $form->submit($trans->__('Submit')); ?></li>
</ul>
<?php echo $form->end(); ?>
<?php if (Configure::read('SparkPlug.open_registration')): ?>
<p><?php echo $trans->__('Not registered yet?');?> <?php echo $html->link($trans->__("Click Here"),"/users/register") ?></p>
<?php endif ?>
<p><?php echo $html->link($trans->__("Forgot your password?"), "/users/forgotPassword") ?></p>