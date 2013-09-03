<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	

<div class="container">


    <div class="grid-16">
        <?php if (count($userInfo) > 0) { ?>
            <form method="POST" action="<?php echo site_url('user/edit/' . $userInfo['id']); ?>" class="form uniformForm">					

                <div class="widget">

                    <div class="widget-header">
                        <span class="icon-article"></span>
                        <h3><?php echo $pageTitle; ?></h3>
                    </div> <!-- .widget-header -->

                    <div class="widget-content">

                        <div class="field-group">
                            <label>User Name:</label>
                            <div class="field">
                                <input type="text" name="username" id="username" size="50" class="" value="<?php echo $userInfo['username']; ?>" disabled="disabled"/>			
                            </div>
                        </div> <!-- .field-group -->

                        <div class="field-group">
                            <label>Full Name:</label>
                            <div class="field">
                                <input type="text" name="fullname" id="fullname" size="50" class="" value="<?php echo $userInfo['fullname']; ?>" />			
                            </div>
                        </div> <!-- .field-group -->

                        <div class="field-group">
                            <label>Email:</label>
                            <div class="field">
                                <input type="text" name="email" id="email" size="50" class="" value="<?php echo $userInfo['email']; ?>" />			
                            </div>
                        </div> <!-- .field-group -->

                        <div class="field-group">
                            <label>Password:</label>
                            <div class="field">
                                <input type="password" name="password" id="password" size="50" value="********" disabled="disabled"/>
                            </div>
                        </div> <!-- .field-group -->

                        <div class="field-group">		
                            <label>Role:</label>

                            <div class="field">
                                <select name="role" id="role" style="width: 383px;">
                                    <?php
                                    foreach ($listRole as $role) {
                                        echo '<option value="' . $role['id'] . '">' . $role['role_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>		
                        </div> <!-- .field-group -->
                        <input class="btn btn-small btn-blue" type="submit" value="Save"/>
                        <a href="<?php echo site_url('user'); ?>"><button type="button" id="btn_user_edit_back" class="btn btn-small btn-teal">&nbsp;Back&nbsp;</button></a>
                    </div> <!-- .widget-content -->

                </div> <!-- .widget -->
            </form>
        <?php }; ?>
    </div>
</div>