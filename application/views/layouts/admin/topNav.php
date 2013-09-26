<ul>
    <li>
        <a href="#menuProfile" class="menu">John Doe</a>

        <div id="menuProfile" class="menu-container menu-dropdown">
            <div class="menu-content">
                <ul class="">
                    <li><a href="<?php echo site_url('users/usercp'); ?>">Edit Profile</a></li>
                    <li><a href="javascript:;">Edit Settings</a></li>
                    <li><a href="javascript:;">Suspend Account</a></li>
                </ul>
            </div>
        </div>
    </li>
    <li><a href="javascript:;">Upgrade</a></li>
    <li><a href="<?php echo site_url('users/logout'); ?>">Logout</a></li>
</ul>