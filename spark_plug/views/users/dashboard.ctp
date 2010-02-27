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
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in </p>