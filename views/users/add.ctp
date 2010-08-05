<div class="info">
<h2><?php echo $trans->__("User Add"); ?></h2>
</div>
		
		<?php echo $form->create("User",array("action"=>"add", 'class' => 'wufoo  page')); ?>
		<ul>
		
		<li><?php echo $form->input("username", array('label' => $trans->__('username'), 'class' => 'field text large'))	?></li>
		<li><?php echo $form->input("email", array('label' => $trans->__('Email'), 'class' => 'field text large'))	?></li>
		
		<li><?php echo $form->input("password",array("type"=>"password", 'value' => null, 'label' => $trans->__('password'), 'class' => 'field text large')) ?></li>
		<li><?php echo $form->input("confirm_password",array("type"=>"password", 'label' => $trans->__('confirm password'), 'class' => 'field text large')) ?></li>

		<li><?php echo $form->submit($trans->__('Add')); ?></li>
		</ul>
		<?php echo $form->hidden("user_group_id",array("value"=>"2")); ?>
		<?php echo $form->hidden("active",array("value"=>"1")); ?>
		<?php echo $form->end(); ?>

<p><?php echo $html->link($trans->__("Cancel and go back to users"),"/spark_plug/users/index") ?></p>
