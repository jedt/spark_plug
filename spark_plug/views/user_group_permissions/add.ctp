<?=$html->link('Back to list','/user_group_permissions/index')?>
<h2>Add User Group Permission</h2>

<?=$form->create('UserGroupPermission',array('action'=>'edit'))?>
<?=$form->input('user_group_id',array('type'=>'select','options'=>$userGroups,'empty'=>''))?>
<?=$form->input('controller')?>
<?=$form->input('action')?>
<?=$form->input('alowed',array('type'=>'radio','options'=>array('1'=>'Yes','0'=>'No')))?>
<?=$form->input('id')?>
<?=$form->submit();?>
<?=$form->end();?>