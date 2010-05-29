<?php echo $html->link('Back to list','/user_group_permissions/index'); ?>
<h2>Add User Group Permission</h2>

<?php echo $form->create('UserGroupPermission',array('action'=>'edit')); ?>
<?php echo $form->input('user_group_id',array('type'=>'select','options'=>$userGroups,'empty'=>'')); ?>
<?php echo $form->input('controller'); ?>
<?php echo $form->input('action'); ?>
<?php echo $form->input('alowed',array('type'=>'radio','options'=>array('1'=>'Yes','0'=>'No'))); ?>
<?php echo $form->input('id'); ?>
<?php echo $form->submit();?>
<?php echo $form->end();?>