<h2><?php echo $trans->__('Password recovery'); ?></h2>
<p><?php echo $trans->__('Please enter the e-mail used during registration'); ?> </p>
<?php echo $form->create("User",array("action"=>"forgotPassword")) ?>
<table cellpadding="6" cellspacing="0" border="0" width="95%">
<tr>
	<td>
		<?php echo $form->text("email",array("size"=>"40")) ?>
	</td>
</tr>
<tr>	
	<td>
		<br><?php echo $form->submit($trans->__('Submit')); ?>
	</td>
</tr>
</table>
<?php echo $form->end(); ?>