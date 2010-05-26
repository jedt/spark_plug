<h2><?php echo $trans->__('Welcome'); ?> <?php echo Authsome::get('username');?>!</h2>
<p><?php echo $trans->__('Please select below'); ?>:</p>
<ol>
<?php if (Authsome::check('users/index')):?>
	<li><?php echo $html->link($trans->__('Manage Users'),'/users/index'); ?></li>
	<?php endif;?>
	<?php if (Authsome::check(' user_group_permissions/index')): ?>
	<li><?php echo $html->link($trans->__('Manage Permissions'),'/user_group_permissions/index'); ?>
	</li>
	<?php endif;?>
	<li><?php echo $html->link($trans->__('Change Password'),'/users/change_password'); ?></li>
	<li><?php echo $html->link($trans->__('Logout'),'/users/logout'); ?></li>
</ol>