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
                    res = JSON.parse(res);
                    $('#img_prev').attr('src',res['info']['avatar']);
                    $('#name').val(res['info']['name']);
                    for (var key in res['album']){
                        $('#album').append('<img src="' +res['album'][key]['img_name']+ '" style="height: 100px; margin: 2px;"/>');
                    }
                }
            });
        });

        //Update product info
        function ajaxUpdate() {
            $('#ajaxLoader').show();
            var pId = $('#product_id').val();
            var pName = $('#product_name').val();
            var pCatId = $('#product_cat').val();
            var pStatus = $('#product_status').val();
            if (pId > 0) {
                var data = {
                    'pId': pId,
                    'pName': pName,
                    'pCatId': pCatId,
                    'pStatus': pStatus
                };
                $.ajax({
                    datatype: 'json',
                    url: "product/ajaxUpdate",
                    type: "POST",
                    data: {data: data},
                    success: function(res) {
                        data2 = JSON.parse(res);
                        if (data2['error'] == '0') {
                            $('#product_tbl tbody tr.chosen td[rel=id]').html(data2['id']);
                            $('#product_tbl tbody tr.chosen td[rel=image_path] img').attr('src', data2['image_path']);
                            $('#product_tbl tbody tr.chosen td[rel=pname]').html(data2['name']);
                            $('#product_tbl tbody tr.chosen td[rel=title]').html(data2['title']);
                        }
                        $('#ajaxLoader').hide();
                    }
                });
            }
        }

        $('#product_name').change(function() {
            ajaxUpdate();
        });
        $('#product_cat').change(function() {
            ajaxUpdate();
        });
        $('#product_status').change(function() {
            ajaxUpdate();
        });

        //Update Img product
        function ajaxUploadImg(Object) {
            $('#ajaxLoader').show();
            var formdata = new FormData();
            var file = Object.files[0];
            var pId = $('#product_id').val();
            if (pId != '') {
                if (!!file.type.match(/image.*/)) {
                    if (formdata) {
                        formdata.append("image", file);
                        formdata.append("pId", pId);
                    }
                }

                if (formdata) {
                    $.ajax({
                        url: "product/ajaxUpdateImgProduct",
                        type: "POST",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            var data2 = JSON.parse(res);
                            if (data2['error'] == '0') {
                                $('#product_tbl tbody tr.chosen td[rel=image_path] img').attr('src', data2['image_path']);
                            }
                            $('#ajaxLoader').hide();
                        }
                    });
                }
            } else {
                return false;
            }
        }

        $('#icon_path').change(function() {
            ajaxUploadImg(this);
        });



    });
});