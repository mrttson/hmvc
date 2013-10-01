$(function() {
    $(document).ready(function() {
        //Index page
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
            clearInterval(intervalID);
            $('#ajaxLoader').css('display', 'block');
            var imgcount = 0;
            $.ajax({
                datatype: 'json',
                url: "myteam/ajaxGetImg",
                type: "POST",
                data: {data: index},
                complete: function() {
                    if (imgcount > 0) {
                        var carousel = $("#carousel").waterwheelCarousel();
                        intervalID = setInterval(function() {
                            carousel.next();
                        }, 2000);
                    } else {
                        return false;
                    }

                },
                success: function(res) {
                    res = JSON.parse(res);
                    console.log(res);
                    $('#carousel').html('');
                    if (res['error'] == '0') {
                        for (var key in res['image']) {
                            if (key != 'error') {
                                imgcount++;
                                var thumb = res['image'][key]['thumb_path'];
                                $('#carousel').append('<a href="#"><img class="imgNew" width="320px" height="180px" class="newIMG" src="' + thumb + '" /></a>');
                                $('#carousel .imgNew').load(function() {

                                });
                            }
                        }
                    }
                    $('#ajaxLoader').css('display', 'none');
                }
            });
        }

        //getImg(teamIndex['son']);
        $('.album').click(function() {
            getImg($(this).attr('mid'));
        });

        $('.reload').click(function() {
            var carousel = $("#carousel").waterwheelCarousel();
            carousel.reload();
            return false;
        });

        //Team list page
        $('#myteam_tbl tbody tr').click(function() {
            if (!$(this).hasClass('chosen')) {
                var mid = $(this).attr('mid');
                var data = {'mid': mid};
                $('#myteam_tbl tbody tr.chosen').removeClass('chosen');
                $(this).addClass('chosen');
                $.ajax({
                    datatype: 'json',
                    url: "myteam/ajaxGetMemberInfo",
                    type: "POST",
                    data: {data: data},
                    success: function(res) {
                        $('#album').html('');
                        res = JSON.parse(res);
                        $('#img_prev').attr('src', res['info']['avatar']);
                        $('#mid').val(res['info']['id']);
                        $('#name').val(res['info']['name']);
                        for (var key in res['album']) {
                            var htmlString = '<tr pid="" style="text-align: center;">'
                                    + '<td rel="pid">'
                                    + '<input type="checkbox" name="checkbox" class="newcheckbox" id="checkbox1" value="1" />'
                                    + '</td>'
                                    + '<td rel="image_path">'
                                    + '<a>Delete</a>'
                                    + '</td>'
                                    + '<td rel="pname">'
                                    + '<img class="product_image" src="' + res['album'][key]['thumb_path'] + '" alt="your image" style="height: 100px;"/>'
                                    + '</td>'
                                    + '</tr>';
                            $('#album').append(htmlString);
                            $('.newcheckbox').uniform();
                            $('.newcheckbox').removeClass('newcheckbox');
                        }
                    }
                });
            }
        });

        function clearFileInputField(tagId) {
            document.getElementById(tagId).innerHTML = document.getElementById(tagId).innerHTML;
        }

        $('#album_upload').change(function() {
            formdata = false;
            if (window.FormData) {
                formdata = new FormData();
            }
            var i = 0, len = this.files.length, file;
            var mid = $('#mid').val();
            if (mid != '') {
                $('#ajaxLoader').show();
                for (; i < len; i++) {
                    file = this.files[i];
                    if (!!file.type.match(/image.*/)) {
                        if (formdata) {
                            formdata.append('mid', mid);
                            formdata.append("images[]", file);
                        }
                    }
                }
                if (formdata) {
                    $.ajax({
                        url: "myteam/ajaxUploadAlbum",
                        type: "POST",
                        data: formdata,
                        complete: function() {
                            $('#ajaxLoader').hide();
                            clearFileInputField('album_upload');
                        },
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res['error'] == '0') {
                                res['album'].forEach(function(entry) {
                                    var htmlString = '<tr pid="" style="text-align: center;">'
                                            + '<td rel="pid">'
                                            + '<input type="checkbox" name="checkbox" class="newcheckbox" id="checkbox1" value="1" />'
                                            + '</td>'
                                            + '<td rel="image_path">'
                                            + '<a>Delete</a>'
                                            + '</td>'
                                            + '<td rel="pname">'
                                            + '<img class="product_image" src="' + entry + '" alt="your image" style="height: 100px;"/>'
                                            + '</td>'
                                            + '</tr>';
                                    $('#album').append(htmlString);
                                    $('.newcheckbox').uniform();
                                    $('.newcheckbox').removeClass('newcheckbox');
                                })
                            }
                        }
                    });
                }
            } else {
                alert('Please choose member');
                return false;
            }
        });
    });
});