<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title><?php echo $pageTitle; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/icon.png" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/all.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/sample_pages/gallery.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/reset.css" type="text/css" media="screen" title="no title" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/text.css" type="text/css" media="screen" title="no title" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/buttons.css" type="text/css" media="screen" title="no title" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/theme-default.css" type="text/css" media="screen" title="no title" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/register.css" type="text/css" media="screen" title="no title" />
        <script src="<?php echo base_url(); ?>public/js/jquery-1.7.2.js"></script>
        <script src="<?php echo base_url(); ?>public/js/all.js"></script>
        <script src="<?php echo base_url(); ?>public/js/gen_validatorv4.js"></script>
    </head>

    <body>

        <div id="register">
            <h1>Dashboard</h1>
            <div id="register_panel">
                <form id="register_form" action="<?php echo site_url('user/register'); ?>" method="post" accept-charset="utf-8">		
                    <div class="register_fields">
                        <div class="field">
                            <label for="email">Account Name </label>
                            <input type="text" name="username" value="" id="username" tabindex="1" placeholder="account name" />		
                        </div>

                        <div class="field">
                            <label for="password">Password </label>
                            <input type="password" name="password" value="" id="password" tabindex="2" placeholder="password" />			
                        </div>

                        <div class="field">
                            <label for="cfpassword">Confirm Password </label>
                            <input type="password" name="cfpassword" value="" id="cfpassword" tabindex="2" placeholder="confirm password" />			
                        </div>

                        <div class="field">
                            <label for="email">Email </label>
                            <input type="text" name="email" value="" id="email" tabindex="2" placeholder="email" />			
                        </div>

                        <div class="field">
                            <label for="fullname">Full Name </label>
                            <input type="text" name="fullname" value="" id="fullname" tabindex="2" placeholder="full name" />			
                        </div>
                        
                        <div class="field">
                            <div id='register_form_errorloc' class='error_strings'></div>
                        </div>
                    </div> <!-- .login_fields -->

                    <div class="register_actions">
                        <button type="submit" class="btn btn-primary" tabindex="3">Register</button>
                    </div>
                </form>
            </div> <!-- #login_panel -->		
        </div> <!-- #login -->

        <script src="javascripts/all.js"></script>
        <script  type="text/javascript">
            var frmvalidator = new Validator("register_form");
            frmvalidator.EnableOnPageErrorDisplaySingleBox();
            frmvalidator.EnableMsgsTogether();
            
            frmvalidator.addValidation("username", "req", "Please enter your First Name");
            frmvalidator.addValidation("username", "maxlen=50", "Max length for Account Name is 50");

            frmvalidator.addValidation("password", "req", "Please enter Password");

            frmvalidator.addValidation("cfpassword", "eqelmnt=password", "The confirmed password is not same as password");

            frmvalidator.addValidation("email", "req", "Please enter Email");
            frmvalidator.addValidation("email", "maxlen=50");
            frmvalidator.addValidation("email", "email");

            frmvalidator.addValidation("fullname", "maxlen=50");
        </script>

    </body>
</html>