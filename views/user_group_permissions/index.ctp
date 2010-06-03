<?php echo $html->link('Back to dashboard','/users/dashboard'); ?> | <?php echo $html->link(__('New User Group Permission', true), array('action'=>'add')); ?>

<h2>User Group Permissions</h2>
<div class="table_wrap browse">
<table class="full" cellspacing="1" cellpadding="4" border="0" bgcolor="#dddddd" width="100%">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('user_group_id');?></th>
	<th><?php echo $paginator->sort('plugin');?></th>
	<th><?php echo $paginator->sort('controller');?></th>
	<th><?php echo $paginator->sort('action');?></th>
	<th><?php echo $paginator->sort('allow');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($permissions as $permission):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $permission['UserGroupPermission']['id']; ?>
		</td>
		<td>
			<?php echo $permission['UserGroup']['name']; ?>
		</td>
		<td>
			<?php echo $permission['UserGroupPermission']['plugin']; ?>
		</td>
		<td>
			<?php echo $permission['UserGroupPermission']['controller']; ?>
		</td>
		<td>
			<?php echo $permission['UserGroupPermission']['action']; ?>
		</td>
		<td>
			<?php echo $permission['UserGroupPermission']['allowed']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $permission['UserGroupPermission']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $permission['UserGroupPermission']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $permission['UserGroupPermission']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
