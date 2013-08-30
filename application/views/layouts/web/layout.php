<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url(); ?>/public/css/style.css" rel="stylesheet" type="text/css" />
        <title><?php echo $title; ?></title>
    </head>

    <body>
        <?php $this->load->view("layouts/web/top"); ?>
        <div id="main">
            <?php $this->load->view("layouts/web/left"); ?>
            <div id="info">
                <?php
                $this->load->view($page, $data);
                ?>
            </div>
        </div>
        <?php $this->load->view("layouts/web/bottom"); ?>
    </body>
</html>