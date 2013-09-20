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
            var intervalID = 0;
            //Get img member
            function getImg(index) {
                var sStatus = false;
                $.ajax({
                    datatype: 'json',
                    url: "myteam/ajaxGetImg",
                    type: "POST",
                    data: {data: index},
                    complete: setInterval(function() {
                        if (sStatus == true) {
                            var carousel = $("#carousel").waterwheelCarousel();
                            intervalID = setInterval(function() {
                                carousel.next();
                            }, 2000);
                        } else {
                            if (intervalID != 0) {
                                clearInterval(intervalID);
                            }
                        }
                    }, 2000),
                    success: function(res) {
                        res = JSON.parse(res);
                        console.log(res);
                        $('#carousel').html('');
                        if (res['error'] == '0') {
                            sStatus = true;
                            for (var key in res['image']) {
                                if (key != 'error') {
                                    var img_name = res['image'][key];
                                    $('#carousel').append('<a href="#"><img class="newIMG" src="' + img_name + '" /></a>');
                                    $('#carousel .newIMG').load(function() {
                                        $(this).hide();
                                    });
                                }
                            }
                        }
                    }
                });
            }


            $(document).ready(function() {



                //getImg(teamIndex['son']);

                $('.album').click(function() {
                    getImg(teamIndex[$(this).attr('rel')]);
                });

                $('.reload').click(function() {
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
                    <li class="sliding-element album" rel="son"><a href="javascript:;">Album 1</a></li>
                    <li class="sliding-element album" rel="thu"><a href="javascript:;">Album 2</a></li>
                    <li class="sliding-element album" rel="hue"><a href="javascript:;">Album 3</a></li>
                    <li class="sliding-element reload"><a href="javascript:;">RELOAD</a></li>
                </ul>
            </div>
            <div id = "chatBox" style="float: right;">
                <textarea></textarea>
                <button id="send_btn">Send</button>
            </div>
        </div>
    </body>
</html>