<?=$html->link('Back to list','/users/index')?> | <?=$html->link('Log in as this User','/users/login_as_user/'.$this->data['User']['id'])?>
<h2>Edit User</h2>
<?=$form->create('User',array('action'=>'edit'))?>
<table class="formTable" width="100%">
<?=$form->input('user_group_id',array('type'=>'select','options'=>$userGroups))?>
<?=$form->input('username')?>
<?=$form->input('email')?>
<?=$form->input('phone')?>
<?=$form->input('active')?>
<?=$form->input('first_name')?>
<?=$form->input('last_name')?>
<?=$form->input('country')?>
<?=$form->input('city')?>
<?=$form->input('state')?>
<?=$form->input('zip_code')?>
<?=$form->input('id')?>
<?=$form->submit()?>
<?=$form->end()?>
</table>