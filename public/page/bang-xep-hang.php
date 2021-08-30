<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = 'Bảng xếp hạng | '.getSite('title');
    require_once("header.php");
    require_once("nav.php");
?>
<?php
if(getSite('show_top') != 'ON')
{
    msg_warning("Chức năng này đang bảo trì", BASE_URL(''), 500);
}
?>
<!--============= Feature Section Starts Here =============-->
<section class="feature-section padding-top padding-bottom oh pos-rel">
    <div class="feature-shapes d-none d-lg-block">
        <img src="<?=BASE_URL('template/mosto/');?>assets/images/feature/feature-shape.png" alt="feature">
    </div>
    <div class="container">
        <div class="section-header mw-725">
            <h5 class="cate">BẢNG XẾP HẠNG ĐẠI GIA</h5>
            <h3 class="title"><a href="<?=BASE_URL('');?>"><?=getSite('title');?></a></h3>
        </div>
        <div class="trial-wrapper padding-bottom pr">
            <div class="table-responsive">
                <table class="table table-padded">
                    <thead style="color: white;">
                        <tr>
                            <th>TOP</th>
                            <th>SỐ ĐIỆN THOẠI</th>
                            <th>TỔNG TIỀN CƯỢC</th>
                        </tr>
                    </thead>
                    <tbody style="color: white;">
                        <?php $i = 1; foreach($CMSNT->get_list(" SELECT * FROM `bang_xep_hang` ORDER BY amount DESC LIMIT 10 ") as $row){?>
                        <tr>
                            <td><?=$i++;?></td>
                            <td><b>*****<?=substr($row['sdt'], 5);?></b></td>
                            <td><b><?=format_cash($row['amount']);?> VNĐ</b></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>

    </div>
</section>


<?php require_once("footer.php");?>