<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>TTVD</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/myteam.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.waterwheelCarousel.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/sliding_effect.js"></script>
        <script type="text/javascript">
            var teamIndex = {
                'son': '0',
                'thu': '1',
                'hue': '2',
                'van': '3',
                'phuong': '4',
                'lam': '5',
                'duy': '6',
                'thao': '7',
                'chinh': '8',
                'nguyet': '9'
            };

            //Get img member
            function getImg(index) {
                var sStatus = false;
                $.ajax({
                    datatype: 'json',
                    url: "myteam/ajaxGetImg",
                    type: "POST",
                    data: {data: index},
                    complete: function() {
                        var carousel = $("#carousel").waterwheelCarousel();
                        setInterval(function() {
                            carousel.next()
                        }, 2000);
                    },
                    success: function(res) {
                        res = JSON.parse(res);
                        if (res['errror'] = '0'){
                            sStatus = true;
                        }
                        var htmlImg = '';
                        $('#carousel').html('');
                        for (var key in res) {
                            if (key != 'error') {
                                var img_name = res[key]['img_name'];
                                $('#carousel').append('<a href="#"><img src="<?php echo base_url(); ?>public/images/myteam/' + img_name + '" /></a>');
                            }
                        }

                    }
                });
            }

            $(document).ready(function() {

                //getImg(teamIndex['son']);

                $('.album').click(function() {
                    //getImg(teamIndex['son']);
                    
                    alert($(this).attr('rel'));
                });

                $('#thu2').click(function() {
                    var carousel = $("#carousel").waterwheelCarousel();
                    carousel.reload();
                    return false;
                });
                //var carousel = $("#carousel").waterwheelCarousel();
//                $('#son').bind('click', function() {
//                    carousel.reload();
//                    return false;
//                });
//                $('#thu2').click(function() {
//                    $('#carousel').html('');
//                });
//                setInterval(function() {
//                    //carousel.next()
//                }, 2000);
            });
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
                    <li class="sliding-element album" rel="1"><a href="javascript:;">Album 1</a></li>
                    <li class="sliding-element album" rel="2"><a href="javascript:;">Album 2</a></li>
                    <li class="sliding-element album" rel="3"><a href="javascript:;">Album 3</a></li>
                </ul>
            </div>
            <div id = "chatBox" style="float: right;">
                <textarea></textarea>
                <button id="send_btn">Send</button>
            </div>
        </div>
    </body>
</html>