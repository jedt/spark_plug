<h2><?php echo $trans->__('Activate your password'); ?></h2>
<?php echo $form->create("User", array("action"=>"activate_password")) ?>
<?php echo $form->input('password', array('label' => $trans->__('password'))); ?>
<?php echo $form->input('confirm_password',array('type'=>'password', 'label' => $trans->__('confirm password'))); ?>
<?php echo $form->hidden('ident',array('value'=>$ident)); ?>
<?php echo $form->hidden('activate',array('value'=>$activate)); ?>
<?php echo $form->submit($trans->__('Submit')); ?>
<?php echo $form->end(); ?>