<?php echo $html->link('Back to list','/users/index'); ?> | <?php echo $html->link('Log in as this User','/users/login_as_user/'.$this->data['User']['id']); ?>
<h2>Edit User</h2>
<?php echo $form->create('User',array('action'=>'edit')); ?>
<table class="formTable" width="100%">
<?php echo $form->input('user_group_id',array('type'=>'select','options'=>$userGroups)); ?>
<?php echo $form->input('username'); ?>
<?php echo $form->input('email'); ?>
<?php echo $form->input('phone'); ?>
<?php echo $form->input('active'); ?>
<?php echo $form->input('first_name'); ?>
<?php echo $form->input('last_name'); ?>
<?php echo $form->input('country'); ?>
<?php echo $form->input('city'); ?>
<?php echo $form->input('state'); ?>
<?php echo $form->input('zip_code'); ?>
<?php echo $form->input('id'); ?>
<?php echo $form->submit(); ?>
<?php echo $form->end(); ?>
</table>