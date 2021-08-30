<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'CHỈNH SỬA THÔNG TIN VÍ | '.getSite('title');
    require_once("../../public/admin/Header.php");
    require_once("../../public/admin/Sidebar.php");
    CheckLogin();
    CheckAdmin();
?>
<?php
if(isset($_GET['id']) && $getUser['level'] == 'admin')
{
    $id = check_string($_GET['id']);
    $row = $CMSNT->get_row("SELECT * FROM `accounts_momo` WHERE `id` = '$id' ");
    if(!$row)
    {
        admin_msg_error("Dữ liệu này không tôn tại trong hệ thống", BASE_URL('public/admin/momo.php'), 2000);
    }
}
if(isset($_POST['saveMOMO']) && $getUser['level'] == 'admin')
{
    $sdt = check_string($_POST['sdt']);
    $name = check_string($_POST['name']);
    $token = check_string($_POST['token']);
    $status = check_string($_POST['status']);
    $password = check_string($_POST['password']);

    if(empty($sdt))
    {
        admin_msg_error('Vui lòng nhập số điện thoại', '', 2000);
    }
    if(empty($name))
    {
        admin_msg_error('Vui lòng nhập tên chủ ví', '', 2000);
    }
    if(empty($token))
    {
        admin_msg_error('Vui lòng nhập token', '', 2000);
    }
    if(empty($password))
    {
        admin_msg_error('Vui lòng nhập mật khẩu ví momo', '', 2000);
    }
    if($status == 'ON')
    {
        $CMSNT->update('accounts_momo', [
            'status'    => 'OFF'
        ], " `id` != '$id'  ");
    }
    $CMSNT->update('accounts_momo', [
        'sdt'   => $sdt,
        'name'  => $name,
        'token' => $token,
        'status' => $status,
        'password'  => $password
    ], " `id` = '$id' ");
    admin_msg_success('Thêm thành công', '', 500);
}
?>



<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách ví MOMO</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">EDIT VÍ MOMO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại ví MOMO</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="sdt" value="<?=$row['sdt'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên chủ ví</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="name" value="<?=$row['name'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Token</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="token" value="<?=$row['token'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password ví MOMO</label>
                                <div class="col-sm-9">
                                    <div class="form-line">
                                        <input type="text" name="password" value="<?=$row['password'];?>" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tài khoản nhận tiền</label>
                                <div class="col-sm-9">
                                    <select class="form-control show-tick" name="status" required>
                                        <option value="<?=$row['status'];?>"><?=$row['status'];?></option>
                                        <option value="OFF">OFF</option>
                                        <option value="ON">ON</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="saveMOMO" class="btn btn-primary btn-block">
                                <span>LƯU NGAY</span></button>
                                <a type="button" href="<?=BASE_URL('public/admin/momo.php');?>"
                                class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>    
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">DANH SÁCH VÍ MOMO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="thongbao"></div>
                        <div class="table-responsive">
                            <table id="datatable1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>SDT</th>
                                        <th>TÊN CHỦ VÍ</th>
                                        <th>TOKEN</th>
                                        <th>ACTIVE</th>
                                        <th>CONTROL PANEL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `accounts_momo` ORDER BY id DESC ") as $row){ ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$row['sdt'];?></td>
                                        <td><?=$row['name'];?></td>
                                        <td><?=$row['token'];?></td>
                                        <td><?=display_active($row['status']);?></td>
                                        <td>
                                            <a class="btn btn-primary btnEdit" href="<?=BASE_URL('public/admin/edit-momo.php?id='.$row['id']);?>"><i
                                                    class="fas fa-edit"></i>
                                                <span>EDIT</span>
                                            </a>
                                            <a class="btn btn-danger btnDelete" href="<?=BASE_URL('public/admin/momo.php?delete='.$row['id']);?>"><i
                                                    class="fas fa-trash"></i>
                                                <span>DELETE</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<script>
$(function() {
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $("#datatable2").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<?php 
    require_once("../../public/admin/Footer.php");
?>