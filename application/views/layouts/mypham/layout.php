<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/h.css" rel="stylesheet" type="text/css"/>
        <link href="css/lightbox.css" rel="stylesheet" type="text/css"/>
        <link href="css/contact.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
        <link rel="stylesheet" href="css/popup.css" />
        <script type="text/javascript">jQuery.noConflict();</script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script src="js/jquery.ui.widget.js" type="text/javascript"></script>
        <script src="js/jquery.ui.tabs.js" type="text/javascript"></script>
        <script src="js/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/lightbox.js"></script>
        <script type="text/javascript" src="js/jquery.simplemodal.js"></script>
        <script type="text/javascript" src="js/contact.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <title>New step</title>
        <META NAME="KEYWORDS" CONTENT="">
            <META NAME="DESCRIPTION" CONTENT="">
                <script type="text/javascript" language="javascript" src="js/jquery-1.8.2.min.js"></script>
                <script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
                <script type="text/javascript" src="js/jquery.popupMiendatweb.min.js"></script>
                <script type="text/javascript" language="JavaScript">
                    $(function() {
                        /* khởi tạo popup */
                        $('a[rel*=miendatwebPopup]').showPopup({
                            top: 200, //khoảng cách popup cách so với phía trên
                            closeButton: ".close_popup", //khai báo nút close cho popup
                            scroll: false, //cho phép scroll khi mở popup, mặc định là không cho phép
                            onClose: function() {
                                //sự kiện cho phép gọi sau khi đóng popup, cho phép chúng ta gọi 1 số sự kiện khi đóng popup, bạn có thể để null ở đây
                            }
                        });
                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".close").click(function() {
                            $(".bao_popup, #lean_overlay ").hide();
                        });
                    });
                </script> 
                </head>
                <body>
                    <div id="theH">
                        <a href='#'><h1><strong>dầu gội đầu</strong></h1></a>dầu gọi đầu dùng để chăm sóc tóc<a href='#'><h2><strong>công cụ
                                    làm tóc</strong></h2></a>công cụ làm tóc bao gồm tất cả các công cụ chăm sóc tóc và làm đẹp tóc<a href='#'><h3>
                                <strong>thuốc nhuộm tóc</strong></h3></a>thuốc nhuộm tóc có rất nhiều loại, đa dạng về màu sắc mang đến nhiều sự lựa
                        chọn cho khách hàng<a href='#'><h4><strong>thuốc duỗi tóc</strong></h4></a>thuốc duỗi tóc dùng để chăm sóc tóc, giúp
                        tóc trở nên mềm mại và xuông mượt<a href='#'><h5><strong>thuốc trị gầu tóc</strong></h5></a>thuốc trị gàu tóc giúp
                        mái tóc sạch gầu nhanh chóng<a href='#'><h6><strong>keo vuốt tóc</strong></h6></a>keo vuốt tóc giúp cho tạo kiểu tóc
                        dễ dàng và nhanh chóng
                    </div>
                    <!--end the h-->
                    <div id="boc">
                        <?php
                        include('template/banner.php');
                        ?>
                        <!--end menu-->
                        <?php
                        include('template/menu.php');
                        ?>
                        <!--end menu-->
                        <?php
                        include('template/slide.php');
                        ?>
                        <div id="bong"></div>
                        <!--end slide-->
                        <?php include('template/_content.php'); ?>
                        <!--noi dung-->
                        <div id="footer">
                            <div class="footl">
                                <div style="width:100%">
                                    <div class="footer1" style="width:auto; padding-left: 20px;">
                                        <p class="to14 upper">Công ty cổ phần id việt nam</p>
                                        <p>Địa chỉ giao dịch: Tầng 1 só 50/16 Phan Văn Trường - Cầu Giấy - Hà Nội</p>
                                        <p>Điện thoại: 0463299409 <span class="cach">Hotline: 0984930745</span> </p>
                                        <p>Email: infor@idviet.com <span class="cach">Website: http://idviet.com</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="footr">
                                <div id="footl">
                                    <b>
                                        <a href="#">Trang chủ</a> |
                                        <a href="#">Giới thiệu</a> |
                                        <a href="#">Sản phẩm</a> |
                                        <a href="#">Tin tức</a> |
                                        <a href="#">Liên hệ</a>
                                    </b>
                                </div>
                                <div id="footer1" style="margin-top:10px;">
                                    <p style="margin-bottom:0px; text-align:right">
                                        <p style="margin-top:10px;">Lượt Truy Cập : 3722</p>
                                    </p>

                                    <p style="margin-top:0; float:right"><p>Design by <a href="#">IDviet</a></p></p>
                                </div>
                            </div>
                        </div>
                        <!--end fotter-->
                        <div class="bao_popup">
                            <!--<div class="left">
                                <img style="border: none;" src="images/logo_pp.png"/>
                            </div>-->
                            <div class="right">
                                <h2>Thông tin đặt hàng</h2>
                                <form id="form">
                                    <table>
                                        <tr>
                                            <td width="80px">Họ tên:</td><td colspan="2"><input class="dobong" type="text" name="tendn" value="Họ tên" onblur="if (this.value == '')
                            this.value = 'Họ tên';" onfocus="if (this.value == 'Họ tên')
                            this.value = '';"  title="Search For"/></td>
                                        </tr>
                                        <tr>
                                            <td width="80px">Email:</td><td colspan="2"><input class="dobong" type="text" name="tendn" value="Email" onblur="if (this.value == '')
                            this.value = 'Email';" onfocus="if (this.value == 'Email')
                            this.value = '';"  title="Search For"/></td>
                                        </tr>
                                        <tr>
                                            <td width="80px">Điện thoại:</td><td colspan="2"><input class="dobong" type="text" name="tendn" value="Điện thoại" onblur="if (this.value == '')
                            this.value = 'Điện thoại';" onfocus="if (this.value == 'Điện thoại')
                            this.value = '';"  title="Search For"/></td>
                                        </tr>
                                        <tr>
                                            <td width="80px">Nội dung:</td><td colspan="2"><input class="dobong" type="text" name="tendn" value="Nội dung" onblur="if (this.value == '')
                            this.value = 'Nội dung';" onfocus="if (this.value == 'Nội dung')
                            this.value = '';"  title="Search For"/></td>
                                        </tr>

                                    </table>
                                    <input type="button" value="Gửi" name="dn" class="dn"/><input type="button" value="Hủy" name="dn" class="dn"/>
                                </form>

                            </div>
                            <div class="close">
                                <a href="#" id="close_nut"><img src="" style="background-position: bottom;"/></a>
                            </div>
                        </div>
                    </div>
                    <!--end boc-->
                </body>
                </html>