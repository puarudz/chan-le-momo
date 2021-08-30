<!DOCTYPE html>
<!-- MÃ NGUỒN CHƠI CHẴN LẺ MOMO TỰ ĐỘNG PHIÊN BẢN <?=$version;?> -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title;?></title>
    <meta name="description" content="<?=getSite('description');?>">
    <meta name="keywords" content="<?=getSite('keywords');?>">
    <link rel="apple-touch-icon" href="<?=getSite('favicon');?>">
    <link rel="shortcut icon" href="<?=getSite('favicon');?>">

    <!-- Open Graph data -->
    <meta property="og:title" content="<?=$title;?>">
    <meta property="og:type" content="Website">
    <meta property="og:url" content="<?=BASE_URL('');?>">
    <meta property="og:image" content="<?=getSite('image');?>">
    <meta property="og:description" content="<?=getSite('description');?>">
    <meta property="og:site_name" content="<?=getSite('title');?>">
    <meta property="article:section" content="<?=getSite('description');?>">
    <meta property="article:tag" content="<?=getSite('keywords');?>">
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->


    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-default/default.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="<?=BASE_URL('template/mosto/');?>assets/css/minified.css">
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
</head>


<body>
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
    <div class="overlay"></div>
    <!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->


<?php 

if(!isset($_SESSION['username']))
{
    if(getSite('status') == 'OFF')
    {
        msg_warning2("Hệ thống đang bảo trì vui lòng quay lại sau");
    }
}