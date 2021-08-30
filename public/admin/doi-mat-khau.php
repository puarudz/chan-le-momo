<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'THAY ĐỔI MẬT KHẨU | '.getSite('title');
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    CheckLogin();
    CheckAdmin();
?>
<?php
if(isset($_POST['btnChangePassword']) && $getUser['level'] == 'admin')
{
    $password = check_string($_POST['password']);
    $repassword = check_string($_POST['repassword']);

    if($password != $repassword)
    {
        admin_msg_error('Nhập lại mật khẩu không đúng', '', 2000);
    }
    $CMSNT->update("users", [
        'password' => TypePassword($password)
    ], " `id` = '1' ");
    admin_msg_success('Lưu thành công', '', 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thay đổi mật khẩu</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">THAY ĐỔI MẬT KHẨU</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhập mật khẩu mới</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" name="password"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhập lại mật khẩu mới</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="password" name="repassword"
                                            class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="btnChangePassword" class="btn btn-primary btn-block">
                                <span>THAY ĐỔI MẬT KHẨU</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(function() {
    // Summernote
    $('.textarea').summernote()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
})
</script>

<?php 
    require_once("../../public/admin/Footer.php");
?>