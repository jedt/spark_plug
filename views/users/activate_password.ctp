<h2>Activate your password</h2>
<?=$form->create("User",array("action"=>"activate_password")) ?>
<?=$form->input('password')?>
<?=$form->input('confirm_password',array('type'=>'password'))?>
<?=$form->hidden('ident',array('value'=>$ident))?>
<?=$form->hidden('activate',array('value'=>$activate))?>
<?=$form->submit()?>
<?=$form->end() ?>
