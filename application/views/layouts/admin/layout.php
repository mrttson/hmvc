<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title><?php echo $pageTitle; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url(); ?>public/images/icon.png" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/all.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/sample_pages/gallery.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/sample_pages/stream.css" type="text/css" />
        <script src="<?php echo base_url(); ?>public/js/jquery-1.7.2.js"></script>
        
    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <?php $this->load->view("layouts/admin/header",$header); ?>
            </div> <!-- #header -->

            <div id="search">
                <?php $this->load->view("layouts/admin/search",$search); ?>
            </div> <!-- #search -->

            <div id="sidebar">
                <?php $this->load->view("layouts/admin/sidebar", $sideBar); ?>
            </div> <!-- #sidebar -->

            <div id="content">
                <?php
                    $this->load->view($page, $content); 
                ?>
            </div> <!-- #content -->

            <div id="topNav">
                <?php $this->load->view("layouts/admin/topNav",$topNav); ?>
            </div><!-- #topNav -->

            <div id="quickNav">
                <?php $this->load->view("layouts/admin/quickNav",$quickNav); ?>
            </div><!-- #quickNav -->  
        </div>
        <div id="footer">
            <?php $this->load->view("layouts/admin/footer", $footer); ?>
        </div>
        <script src="<?php echo base_url(); ?>public/js/all.js"></script>
        <script src="<?php echo base_url(); ?>public/js/layout.js"></script>
    </body>
</html>
