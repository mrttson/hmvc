<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	

<div class="container">


    <div class="grid-16">

        <form method="POST" action="<?php echo site_url('user/add'); ?>" class="form uniformForm">					

            <div class="widget">

                <div class="widget-header">
                    <span class="icon-article"></span>
                    <h3><?php echo $pageTitle; ?></h3>
                </div> <!-- .widget-header -->

                <div class="widget-content">

                    <div class="field-group">
                        <label>User Name:</label>
                        <div class="field">
                            <input type="text" name="username" id="username" size="50" class="" />			
                        </div>
                    </div> <!-- .field-group -->

                    <div class="field-group">
                        <label>Full Name:</label>
                        <div class="field">
                            <input type="text" name="fullname" id="fullname" size="50" class="" />			
                        </div>
                    </div> <!-- .field-group -->

                    <div class="field-group">
                        <label>Email:</label>
                        <div class="field">
                            <input type="text" name="email" id="email" size="50" class="" />			
                        </div>
                    </div> <!-- .field-group -->
                    
                    <div class="field-group">
                        <label>Password:</label>
                        <div class="field">
                            <input type="password" name="password" id="password" size="50" />
                        </div>
                    </div> <!-- .field-group -->

                    <div class="field-group">		
                        <label for="cfpassword">Confirm Password:</label>

                        <div class="field">
                            <input type="password" name="cfpassword" id="cfpassword" size="50" />
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
                    <input class="btn btn-small btn-blue" type="submit" value="Add User"/>
                </div> <!-- .widget-content -->

            </div> <!-- .widget -->
        </form>
    </div>
</div>