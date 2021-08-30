<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'Đăng Nhập Quản Trị | '.getSite('title');
    require_once("header.php");
?>

<body>

    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!--============= Sign In Section Starts Here =============-->
    <div class="account-section bg_img" data-background="<?=BASE_URL('template/mosto/');?>assets/css/img/bg-login.jpg">
        <div class="container">
            <div class="account-title text-center">
                <a href="<?=BASE_URL('');?>" class="back-home"><i class="fas fa-angle-left"></i><span>Trở về <span class="d-none d-sm-inline-block">trang chủ</span></span></a>
                <a href="<?=BASE_URL('');?>" class="logo">
                    <img src="<?=getSite('logo');?>" alt="logo">
                </a>
            </div>
            <div class="account-wrapper">
                <div class="account-body">
                    <h4 class="title mb-20">Đăng Nhập Quản Trị</h4>
                    <form class="account-form">
                        <div id="thongbao"></div>
                        <div class="form-group">
                            <label for="sign-up">Tên đăng nhập </label>
                            <input type="text" placeholder="Nhập tên đăng nhập" id="username">
                        </div>
                        <div class="form-group">
                            <label for="pass">Mật khẩu</label>
                            <input type="password" placeholder="Nhập mật khẩu" id="password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" id="Login" class="mt-2 mb-2">Đăng Nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--============= Sign In Section Ends Here =============-->


    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<script type="text/javascript">
$("#Login").on("click", function() {

    $('#Login').html('Đang xử lý').prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("assets/ajaxs/Auth.php");?>",
        method: "POST",
        data: {
            type: 'Login',
            username: $("#username").val(),
            password: $("#password").val()
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#Login').html(
                    'Đăng Nhập')
                .prop('disabled', false);
        }
    });
});
</script>
    <!--=================== RTL Feature Section Ends Here ===================-->
    <!-- <script src="./assets/js/jquery-3.3.1.min.js"></script>
    <script src="./assets/js/modernizr-3.6.0.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/magnific-popup.min.js"></script>
    <script src="./assets/js/jquery-ui.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/waypoints.js"></script>
    <script src="./assets/js/nice-select.js"></script>
    <script src="./assets/js/owl.min.js"></script>
    <script src="./assets/js/counterup.min.js"></script>
    <script src="./assets/js/paroller.js"></script> -->
    <script src="<?=BASE_URL('template/mosto/');?>assets/js/minified.js"></script>
    <script src="<?=BASE_URL('template/mosto/');?>assets/js/main.js"></script>


</body>

</html>