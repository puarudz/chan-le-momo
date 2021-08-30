<?php
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    $title = getSite('title');
    require_once("header.php");
    require_once("nav.php");
?>

<!--============= Feature Section Starts Here =============-->
<section class="feature-section padding-top padding-bottom oh pos-rel">
    <div class="feature-shapes d-none d-lg-block">
        <img src="<?=BASE_URL('template/mosto/');?>assets/images/feature/feature-shape.png" alt="feature">
    </div>
    <div class="container">
        <div class="section-header mw-725">
            <h5 class="cate">HỆ THỐNG CHƠI CHẴN LẺ MOMO TỰ ĐỘNG</h5>
            <h3 class="title"><a href="<?=BASE_URL('');?>"><?=getSite('title');?></a></h3>
        </div>
        <div class="trial-wrapper padding-top padding-bottom pr">
            <div class="ball-1">
                <img src="<?=BASE_URL('template/mosto/');?>assets/images/balls/balls.png" alt="balls">
            </div>
            <div class="cl-white">
                <?=getSite('luu-y-chan-le');?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-5 rtl">
                <div class="feature--thumb style-two pr-xl-4 ltr">
                    <div class="feat-slider owl-carousel owl-theme" data-slider-id="1">
                        <div class="main-thumb">
                            <img src="<?=BASE_URL('assets/img/');?>jrPsQ2k.jpg" alt="feature">
                        </div>
                        <div class="main-thumb">
                            <img src="<?=BASE_URL('assets/img/');?>JdvQTrx.png" alt="feature">
                        </div>
                        <div class="main-thumb">
                            <img src="<?=BASE_URL('assets/img/');?>vgm6aXc.png" alt="feature">
                        </div>
                        <div class="main-thumb">
                            <img src="<?=BASE_URL('assets/img/');?>KdxgLCQ.png" alt="feature">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="feature-wrapper mb-30-none owl-thumbs" data-slider-id="1">
                    <div class="feature-item copy" data-clipboard-target="#copyNoiDung">
                        <div class="feature-thumb">
                            <div class="thumb">
                                <img src="<?=BASE_URL('template/mosto/');?>assets/images/feature/pro1.png"
                                    alt="feature">
                            </div>
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Bước 1</h4>
                            <p>Chuyển tiền cho ví MOMO <b style="font-size:25px" id="copyNoiDung"><?=$CMSNT->get_row("SELECT * FROM `accounts_momo` WHERE `status` = 'ON' ")['sdt'];?></b></p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-thumb">
                            <div class="thumb">
                                <img src="<?=BASE_URL('template/mosto/');?>assets/images/feature/pro2.png"
                                    alt="feature">
                            </div>
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Bước 2</h4>
                            <p>Nhập số tiền cược từ <b style="font-size:25px"><?=format_cash(getSite('min-chan-le'));?>đ</b> đến
                                <b style="font-size:25px"><?=format_cash(getSite('max-chan-le'));?>đ</b>
                            </p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-thumb">
                            <div class="thumb">
                                <img src="<?=BASE_URL('template/mosto/');?>assets/images/feature/pro3.png"
                                    alt="feature">
                            </div>
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Bước 3</h4>
                            <p>Nhập lời nhắn là kết quả cần đặt <b style="font-size:25px">C</b> hoặc <b style="font-size:25px">L</b></p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-thumb">
                            <div class="thumb">
                                <img src="<?=BASE_URL('template/mosto/');?>assets/images/feature/pro4.png"
                                    alt="feature">
                            </div>
                        </div>
                        <div class="feature-content">
                            <h4 class="title">Bước 4</h4>
                            <p>Thực hiện chuyển tiền theo thông tin trên và nhận kết quả</p>
                        </div>
                    </div>
                </div>
                <div class="feat-nav">
                    <a href="#0" class="feat-prev"><i class="flaticon-left"></i></a>
                    <a href="#0" class="feat-next active"><i class="flaticon-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============= Feature Section Ends Here =============-->





<?php require_once("footer.php");?>