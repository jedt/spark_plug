<h2>Welcome <?=Authsome::get('username')?>!</h2>
<p>Please select below:</p>
<ol>
    <?if (Authsome::check(' users/index')):?>
    <li>
        <?=$html->link('Manage Users','/users/index')?>
    </li>
    <?endif;?>
    <?if (Authsome::check(' user_group_permissions/index')):?>
    <li>
        <?=$html->link('Manage Permissions','/user_group_permissions/index')?>
    </li>
    <?endif;?>
    <li><?=$html->link('Change Password','/users/change_password')?></li>
    <li><?=$html->link('Logout','/users/logout')?></li>
</ol>