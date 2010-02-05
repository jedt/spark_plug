<h2>Change Password</h2>
<?=$form->create("User",array("action"=>"change_password")) ?>
<?=$form->input('password')?>
<?=$form->input('confirm_password',array('type'=>'password'))?>
<?=$form->hidden('id')?>
<?=$form->submit()?>
<?=$form->end() ?>