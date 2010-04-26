<? if ($auth->user()): ?>
	<div id="sf-menu-containter">
		<div class="page_margins">
			<ul class="sf-menu">
				<li>
					<?=$html->link("Home","/dashboard")?>
					<ul>
						<li>
							<li><?=$html->link("Change Password", "/users/change_password") ?></li>
						</li>
						<li>
							<a href="http://<?=Configure::read('rootURL')?>/users/logout">Logout</a>
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