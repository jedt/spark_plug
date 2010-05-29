<h2>Change Password</h2>
<?php echo $form->create("User",array("action"=>"change_password")) ?>
<?php echo $form->input('password'); ?>
<?php echo $form->input('confirm_password',array('type'=>'password')); ?>
<?php echo $form->hidden('id'); ?>
<?php echo $form->submit(); ?>
<?php echo $form->end() ?>