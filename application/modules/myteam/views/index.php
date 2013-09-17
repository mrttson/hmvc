<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>TTVD</title>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-1.7.2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery.waterwheelCarousel.js"></script>
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
                //$("#carousel").waterwheelCarousel();
            }

            $(document).ready(function() {

                //getImg(teamIndex['son']);

                $('#album1').click(function() {
                    getImg(teamIndex['thu']);
                });

                $('#album2').click(function() {
                    getImg(teamIndex['hue']);
                });

                $('#album3').click(function() {
                    getImg(teamIndex['van']);
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

        <style type="text/css">
            body {
                font-family:Arial;
                font-size:12px;
                background:#FFF;
            }
            .example-desc {
                margin:3px 0;
                padding:5px;
            }

            #carousel {
                border-radius: 6px;
                width:100%;
                border:1px solid #222;
                height:300px;
                position:relative;
                clear:both;
                overflow:hidden;
                background:gray;
            }
            /*            #carousel img {
                            visibility:hidden;  hide images until carousel can handle them 
                            cursor:pointer;  otherwise it's not as obvious items can be clicked 
                        }*/
        </style>
    </head>
    <body>
        <div id="carousel">
            <div style="text-align: center;">
                <img src="<?php echo base_url(); ?>public/images/ajax-loader.gif" style="display: block;"/>
            </div>
        </div>
        <a href="#" id="album1" style="font-size: 20px;">Album 1</a><br/>
        <a href="#" id="album2" style="font-size: 20px;">Album 2</a><br/>
        <a href="#" id="album3" style="font-size: 20px;">Album 3</a><br/>
        <a href="#" id="thu2" style="font-size: 20px;">Reload</a>
    </body>
</html>

