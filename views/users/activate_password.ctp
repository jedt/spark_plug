<h2>Activate your password</h2>
<?php echo $form->create("User",array("action"=>"activate_password")) ?>
<?php echo $form->input('password'); ?>
<?php echo $form->input('confirm_password',array('type'=>'password')); ?>
<?php echo $form->hidden('ident',array('value'=>$ident)); ?>
<?php echo $form->hidden('activate',array('value'=>$activate)); ?>
<?php echo $form->submit(); ?>
<?php echo $form->end() ?>
