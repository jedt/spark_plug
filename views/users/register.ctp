<div class="info">
<h2><?php echo $trans->__("User Registration"); ?></h2>
</div>
		
		<?php echo $form->create("User",array("action"=>"register", 'class' => 'wufoo  page')); ?>
		<ul>
		
		<li><?php echo $form->input("username", array('label' => $trans->__('username'), 'class' => 'field text large'))	?></li>
		<li><?php echo $form->input("email", array('label' => $trans->__('Email'), 'class' => 'field text large'))	?></li>
		
		<li><?php echo $form->input("password",array("type"=>"password", 'value' => null, 'label' => $trans->__('password'), 'class' => 'field text large')) ?></li>
		<li><?php echo $form->input("confirm_password",array("type"=>"password", 'label' => $trans->__('confirm password'), 'class' => 'field text large')) ?></li>

		<li><?php echo $form->submit($trans->__('Register')); ?></li>
		</ul>
		<?php echo $form->end(); ?>

<p><?php echo $trans->__('Already registered ?');?> <?php echo $html->link($trans->__("Login Here"),"/users/login") ?></p>
