<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>TTVD</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/myteam.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.waterwheelCarousel.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/sliding_effect.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/myteam.js"></script>
        <script type="text/javascript">

        </script>
    </head>
    <body>
        <div id="carousel">
            <!-- slide show Image -->
        </div>
        <div id="mInfo">
            <div id="navigation-block" class="div1">
                <ul id="sliding-navigation">
                    <li class="sliding-element"><h3>Teammate</h3></li>
                    <?php
                    $html = '';
                    if (isset($content['listMember']) && count($content['listMember']) > 0) {
                        foreach ($content['listMember'] as $member)
                            $html .= '<li class="sliding-element album" mid="' . $member['id'] . '"><a href="javascript:;">' . $member['name'] . '</a></li>';
                            
                    }
                    echo $html;
                    ?>
                    <li class="sliding-element reload"><a href="javascript:;">RELOAD</a></li>
                </ul>
            </div>
<!--            <div id = "chatBox" style="float: right;">
                <textarea id="loading_status"></textarea>
                <button id="send_btn">Send</button>
                <div id="ajaxLoader" style="display: none;">
                    <img src="<?php echo base_url() . 'public/images/ajax-loader.gif'; ?>"/>
                </div>
            </div>-->

        </div>
    </body>
</html>