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
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/login.css" type="text/css" media="screen" title="no title" />
        <script src="<?php echo base_url(); ?>public/js/jquery-1.7.2.js"></script>
        <script src="<?php echo base_url(); ?>public/js/all.js"></script>
</head>

<body>

<div id="login">
	<h1>Dashboard</h1>
	<div id="login_panel">
        <form action="<?php echo site_url('user/login'); ?>" method="post" accept-charset="utf-8">		
			<div class="login_fields">
				<div class="field">
					<label for="email">Email</label>
					<input type="text" name="username" value="" id="email" tabindex="1" placeholder="email@example.com" />		
				</div>
				
				<div class="field">
					<label for="password">Password <small><a href="javascript:;">Forgot Password?</a></small></label>
					<input type="password" name="password" value="" id="password" tabindex="2" placeholder="password" />			
				</div>
			</div> <!-- .login_fields -->
			
			<div class="login_actions">
				<button type="submit" class="btn btn-primary" tabindex="3">Login</button>
			</div>
		</form>
	</div> <!-- #login_panel -->		
</div> <!-- #login -->

<script src="javascripts/all.js"></script>


</body>
</html>