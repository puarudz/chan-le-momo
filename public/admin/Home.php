<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'DASHBROAD | '.getSite('title');
    require_once("Header.php");
    require_once("Sidebar.php");
?>

<?php
if(isset($_POST['btnTimKiem']))
{
    $daterangepicker    = check_string($_POST['daterangepicker']);
    $daterangepicker    = explode(' - ', $daterangepicker);
    $listMomo           = $CMSNT->get_list(" SELECT * FROM `momo` WHERE `gettime` >= '".$daterangepicker[0]."' AND `gettime` <= '".$daterangepicker[1]."' ORDER BY id DESC ");
    $total_phien        = $CMSNT->num_rows("SELECT * FROM `momo` WHERE `gettime` >= '".$daterangepicker[0]."' AND `gettime` <= '".$daterangepicker[1]."' ");
    $total_cuoc         = $CMSNT->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `status` != 'refund' AND `gettime` >= '".$daterangepicker[0]."' AND `gettime` <= '".$daterangepicker[1]."' ")['SUM(`amount`)'];
    $total_trathuong    = $CMSNT->get_row("SELECT SUM(`paid`) FROM `momo` WHERE `gettime` >= '".$daterangepicker[0]."' AND `gettime` <= '".$daterangepicker[1]."' ")['SUM(`paid`)'];
}  
else
{

    $total_phien         = $CMSNT->num_rows("SELECT * FROM `momo` ");
    $total_cuoc          = $CMSNT->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `status` != 'refund' ")['SUM(`amount`)'];
    $total_trathuong     = $CMSNT->get_row("SELECT SUM(`paid`) FROM `momo` ")['SUM(`paid`)'];
    $listMomo            = $CMSNT->get_list(" SELECT * FROM `momo` ORDER BY id DESC ");
}
?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#modal-default">CẬP NHẬT PHIÊN BẢN</button>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div id="thongbao"></div>
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->num_rows("SELECT * FROM `momo` "));?></h3>
                        <p>Tổng phiên chơi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `amount` > 0 ")['SUM(`amount`)']);?>đ
                        </h3>
                        <p>Tổng tiền đặt cược</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `status` != 'refund' ")['SUM(`amount`)'] - $CMSNT->get_row("SELECT SUM(`paid`) FROM `momo` WHERE `status` = 'paid' ")['SUM(`paid`)']);?>đ
                        </h3>
                        <p>Tổng lợi nhuận</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->num_rows("SELECT * FROM `momo` WHERE `status` = 'refund'  "));?></h3>
                        <p>Số phiên bị hoàn lại</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sync"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->num_rows("SELECT * FROM `momo` WHERE `gettime` >= DATE(NOW()) AND `gettime` < DATE(NOW()) + INTERVAL 1 DAY "));?>
                        </h3>
                        <p>Tổng phiên chơi hôm nay</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `gettime` >= DATE(NOW()) AND `gettime` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)']);?>đ
                        </h3>
                        <p>Tổng tiền đặt cược hôm nay</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-money-bill-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->get_row("SELECT SUM(`amount`) FROM `momo` WHERE `status` != 'refund' AND `gettime` >= DATE(NOW()) AND `gettime` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'] - $CMSNT->get_row("SELECT SUM(`paid`) FROM `momo` WHERE `status` = 'paid' AND `gettime` >= DATE(NOW()) AND `gettime` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`paid`)']);?>đ
                        </h3>
                        <p>Tổng lợi nhuận hôm nay</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?=format_cash($CMSNT->num_rows("SELECT * FROM `momo` WHERE `status` = 'refund' AND `gettime` >= DATE(NOW()) AND `gettime` < DATE(NOW()) + INTERVAL 1 DAY "));?>
                        </h3>
                        <p>Số phiên bị hoàn lại trong hôm nay</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sync"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">LỊCH SỬ GIAO DỊCH CHẴN LẺ</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" name="daterangepicker" class="form-control float-right"
                                                id="reservationtime">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <button type="submit" name="btnTimKiem" class="btn btn-primary">
                                        <span>TÌM KIẾM</span></button>
                                </div>
                            </div>
                        </form>
                        <ul>
                            <li>Tổng phiên: <b><?=format_cash($total_phien);?></b></li>
                            <li>Tổng cược: <b style="color: green;"><?=format_cash($total_cuoc);?>đ</b></li>
                            <li>Tổng trả tưởng: <b style="color: blue;"><?=format_cash($total_trathuong);?>đ</b></li>
                            <li>Lợi nhuận: <b style="color: red;"><?=format_cash($total_cuoc - $total_trathuong);?>đ</b></li>
                        </ul>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>MÃ GD</th>
                                        <th>SDT</th>
                                        <th>NAME</th>
                                        <th>AMOUNT</th>
                                        <th>COMMENT</th>
                                        <th>TIME</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; foreach($listMomo as $row){ ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><b><?=$row['tranId'];?></b></td>
                                        <td><?=$row['partnerId'];?></td>
                                        <td><?=$row['partnerName'];?></td>
                                        <td><?=$row['amount'];?></td>
                                        <td><?=$row['comment'];?></td>
                                        <td><span class="badge badge-dark"><?=$row['gettime'];?></span></td>
                                        <td><?=dispay_status($row['status']);?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật phiên bản</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Phiên bản hiện tại của bạn là <b style="color: blue;"><?=$version;?></b> phiên bản mới nhất <b
                        style="color:red;"><?=file_get_contents('http://api.cmsnt.co/version.php?version=CHANLEMOMO');?></b>.
                </p>
                <p>1.0.9: Thêm nhiều tài khoản ví MOMO chạy cùng 1 lúc.</p>
                <p>Liên hệ hỗ trợ vui lòng truy cập vào <a href="https://www.cmsnt.co/" target="_blank">www.cmsnt.co</a></p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button type="button" id="update" class="btn btn-primary">Cập nhật ngay</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php if(empty($_SESSION['closeUpdate'])) { $_SESSION['closeUpdate'] = True; ?>

<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        showlog()
    }, 1000)
});

function showlog() {
    $('#modal-default').modal({
        keyboard: true,
        show: true
    });
}
</script>


<?php }?>


<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<script type="text/javascript">
$("#update").on("click", function() {
    $('#update').html(
        'Đang tải bản cập nhật <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>'
        ).prop('disabled',
        true);
    $.ajax({
        url: "<?=BASE_URL("Update.php");?>",
        method: "POST",
        data: {
            type: 'update'
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#update').html(
                    'Cập nhật ngay')
                .prop('disabled', false);
        }
    });
});
</script>

<script>
$(function() {
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
            format: 'YYYY/MM/DD/ hh:mm:ss'
        }
    })
    $("#datatable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});
</script>

<?php 
    require_once("Footer.php");
?>