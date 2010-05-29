<?php if ($auth->user()): ?>
	<div id="sf-menu-containter">
		<div class="page_margins">
			<ul class="sf-menu">
				<li>
					<?php echo $html->link($trans->__('Home'), "/dashboard"); ?>
					<ul>
						<li>
							<li><?php echo $html->link($trans->__("Change Password"), "/users/change_password") ?></li>
						</li>
						<li>
							<?php echo $html->link($trans->__("Disconnect"), "/users/logout") ?>
						</li>
					</ul>
				</li>
			</ul>
			<div id="clear"></div>
		</div>
	</div>
<?endif;?>
<?
//if ($acl->check($auth->user(),"Users/delete"))
//syntax for controller/method check note: must add to permission in initDb
?>