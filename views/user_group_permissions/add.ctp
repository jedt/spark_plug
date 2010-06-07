<?php echo $html->link('Back to list','/user_group_permissions/index'); ?>
<h2>Add User Group Permission</h2>

<?php echo $form->create('UserGroupPermission',array('action'=>'edit')); ?>
<?php echo $form->input('user_group_id',array('type'=>'select','options'=>$userGroups,'empty'=>'')); ?>
<?php echo $form->input('controller', array('after' => $trans->__('Type here your Controller name, case insensitive'))); ?>
<?php echo $form->input('action', array('after' => $trans->__('Type here your Action name, case insensitive, and * for all Actions inside the Controller'))); ?>
<small>
<?php echo $form->input('plugin', array('after' => $trans->__('Leave Plugin field blank if not sure. This is used to set permissions inside your Plugins'))); ?>
</small>
<?php echo $form->input('alowed',array('type'=>'radio','options'=>array('1'=>'Yes','0'=>'No'), 'default' => '1')); ?>
<?php echo $form->input('id'); ?>
<?php echo $form->submit();?>
<?php echo $form->end();?>
