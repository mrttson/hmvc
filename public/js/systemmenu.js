$(function() {
    $(document).ready(function() {
        $('#systemmenu_tbl tbody tr').click(function() {
            $('#ajaxLoader').show();
            var sid = $(this).attr('sid');
            var data = {'sid': sid};
            $.ajax({
                datatype: 'json',
                url: "systemmenu/ajaxGetSystemmenuInfoById",
                type: "POST",
                data: {data: data},
                success: function(res) {
                    res = JSON.parse(res);
                    if (res['error'] == '0') {
                        document.getElementById("img_prev").src = res['icon_path'];
                        $('#systemmenu_id').val(res['id']);
                        $('#systemmenu_title').val(res['title']);
                        $('#systemmenu_url').val(res['url']);
                        $('#systemmenu_order').val(res['orderno']);
                        $('#parent_id').val(res['parent_id']);
                        $('#systemmenu_status').val(res['status']);
                        $('#ajaxLoader').hide();
                    }
                }
            });
        });

        function showErrMsg(msg) {
            $('#errMsg h3').html(msg);
            $('#errMsg').show();
            setTimeout(function() {
                notifyClose();
            }, 1000);
        }

        $('#delete_btn').live('click', function(e) {
            e.preventDefault();
            $.alert({
                type: 'confirm'
                        , title: 'Alert'
                        , text: '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do dolor sit amet, consectetur adipisicing elit, sed do.</p>'
                        , callback: function() {
                            showErrMsg('Delete Success!');
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