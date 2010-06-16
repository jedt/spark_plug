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
		<?php echo $form->input("username", array('label' => $trans->__('username'))) ?>
		<?php echo $form->input("email") ?>
		
		<?php echo $form->input("password", array("value"=>null, 'label' => $trans->__('password'))) ?>
		<?php echo $form->input("confirm_password",array("type"=>"password", 'label' => $trans->__('confirm password'))) ?>
		<?php $defaultGroupId = Configure::read('SparkPlug.default_groupid_for_registration'); ?>
		<?php echo $form->hidden("user_group_id",array("value" => $defaultGroupId)); ?>
		<?php echo $form->submit($trans->__('Submit')) ?>
		<?php echo $form->end(); ?>
	</div>
</div>
<div class="rightcol">
	<h2><?php echo $trans->__('Existing Users'); ?> </h2>
	<?php echo $html->link($trans->__('Login here'),'/users/login'); ?>
</div>
<div style="clear:both"></div>