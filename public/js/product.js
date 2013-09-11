$(function() {
    $(document).ready(function() {
        $('#product_tbl tbody tr').click(function() {
            var pId = $(this).attr('pid');
            var data = {'pId': pId};
            $.ajax({
                datatype: 'json',
                url: "product/getProductInfoById",
                type: "POST",
                data: {data: data},
                success: function(res) {
                    res = JSON.parse(res);
                    $('#product_id').val(res['id']);
                    $('#product_name').val(res['name']);
                    $('#product_id').val(res['id']);
                    $('#product_status').val(res['status']);
                }
            });
        });
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
                        console.log(res);
                        res = JSON.parse(res);
                        if (res['error'] == '0') {

                        } else {

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
        function ajaxUploadImg(Object) {
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
                            //document.getElementById("response").innerHTML = res;
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