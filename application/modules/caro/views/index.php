<html>
    <head>
        <meta charset="utf8"/>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>public/css/caro/caro.css"/>
        <script src="<?php echo base_url(); ?>public/js/jquery-1.7.2.js"></script>
        <script src="<?php echo base_url(); ?>public/js/caro/caro.js"></script>
        <script>
            var img = ["<?php echo base_url() . "public/images/caro/4.gif"; ?>", "<?php echo base_url(). "public/images/caro/2.gif";?>"]
        </script>
    </head>
    <body>
        <div id='selectStyle'>
            <input type=radio name='setstyle' value=2>Style 1: X O
            <input type=radio name='setstyle' value=3>Style 2: <img src="<?php echo base_url(); ?>public/images/caro/4.gif"/> <img src="<?php echo base_url(); ?>public/images/caro/2.gif"/>
        </div>
        <div id='carofield'>

        </div>
        UserName: <input id="loginname" type="text"/>
        <button id="login">Login</button>
        <input type="text" id="requestToken" value=""/>
        <button id="acceptRequestDeal" style="display: none;">Accept</button>
        <button id="declineRequestDeal" style="display: none;">Decline</button>
        <select id ="listPlayerWait" style="width: 100px;">
            <option value="0">&nbsp;</option>
            <?php
                if(isset($content['listUserWait']) && count($content['listUserWait']) > 0){
                    foreach ($content['listUserWait'] as $userWait){
                        $html = '<option value = "'.$userWait['token'].'">'.$userWait['name'].'</option>';
                        echo $html;
                    }
                }
            ?>
        </select>
        <button id="sendDeal">Deal</button>
        <button id="getPlayerWait">Reload</button>
        <div id="msg">Ready!</div>
        <div id="state"></div>
        <input type="hidden" id="token1" value=""/>
        <input type="hidden" id="token2" value=""/>
        <input type="hidden" id="lastId" value="0"/>
        <input type="hidden" id="dealId" value=""/>
        <button id='test1' value="1">Click1</button>
        <button id='test2' value="2">Click2</button>
        <script>
            $(document).ready(function() {
                $('#test1').click(function() {
                    $('#test2').trigger('click');
                });
                $('#test2').click(function() {
                    $(this).html("Clicked");
                });
            });
        </script>
    </body>
</html>