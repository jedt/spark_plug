<h2>Change Password</h2>
<div style="width:320px">
	<?=$form->create("User",array("action"=>"change_password")) ?>
	<table class="formTable">
	
		<?=$formTable->inputCompact('password')?>
		<?=$formTable->inputCompact('confirm_password',array('type'=>'password'))?>
		<?=$form->hidden('id')?>
		<?=$formTable->submit()?>
	</table>
	<?=$form->end() ?>
</div>