<style type="text/css">
	.leftcol
	{
		width:50%;
		float:left;
		padding-right: 24px;
		border-right: 1px solid #ccc;
	}
	.rightcol
	{
		width:40%;
		float:right
	}

</style>
<h2>User Registration</h2>
<div class="leftcol">
	<div class="quickform2 nobackground">
		
		<?php echo $form->create("User",array("action"=>"register","class"=>"yform")) ?>
		<?php echo $form->input("username") ?>
		<?php echo $form->input("email") ?>
		
		<?php echo $form->input("password",array("value"=>null)) ?>
		<?php echo $form->input("confirm_password",array("type"=>"password")) ?>

		<?php echo $form->hidden("user_group_id",array("value"=>"2")); ?>
		<?php echo $form->submit("Register") ?>
		<?php echo $form->end() ?>
	</div>
</div>
<div class="rightcol">
	<h2>Existing Users</h2>
	<?php echo $html->link('Login here','/users/login'); ?>
</div>
<div style="clear:both"></div>
