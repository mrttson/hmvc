$(function() {
    $(document).ready(function() {

        $('#myteam_tbl tbody tr').click(function() {
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