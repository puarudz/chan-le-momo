<?php if(getSite('show_statistics') == 'ON'){ ?>
<section class="">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="counter-wrapper-3">
                    <div class="counter-item">
                        <div class="counter-thumb">
                            <img src="<?=BASE_URL('template/mosto/');?>assets/images/icon/counter1.png" alt="icon">
                        </div>
                        <div class="counter-content">
                            <h2 class="title"><span
                                    class="counter"><?=format_cash($CMSNT->num_rows("SELECT * FROM `momo` "));?></span>
                            </h2>
                            <span class="name">Tổng lượt chơi</span>
                        </div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-thumb">
                            <img src="<?=BASE_URL('template/mosto/');?>assets/images/icon/counter2.png" alt="icon">
                        </div>
                        <div class="counter-content">
                            <h2 class="title"><span class="counter"><?=format_cash(getSite('views'));?></span></h2>
                            <span class="name">Lượt truy cập website</span>
                        </div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-thumb">
                            <img src="<?=BASE_URL('template/mosto/');?>assets/images/icon/counter5.png" alt="icon">
                        </div>
                        <div class="counter-content">
                            <h2 class="title"><span class="counter">95</span><span>%</span></h2>
                            <span class="name">Hài lòng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }?>

<?=getSite('script_live_chat');?>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<!--============= Footer Section Starts Here =============-->
<footer class="footer-section bg_img" data-background="<?=BASE_URL('template/mosto/');?>assets/css/img/footer.jpg">
    <div class="container">
        <div class="copyright">
            <p>
                Copyright © 2021.All Rights Reserved By <a href="<?=BASE_URL('');?>"><?=getSite('title');?></a> |
                Developer By <a href="https://www.cmsnt.co/" target="_blank">CMSNT.CO</a>
            </p>
        </div>
    </div>
</footer>

<script type="text/javascript">
$(document).ready(function() {
    setInterval(function() {
        $("#autoload").load(loadCron())
    }, 10000);
});

function loadCron() {
    $.get("<?=BASE_URL("cron/autoload.php");?>");
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script>
new ClipboardJS('.copy');
</script>
<script src="<?=BASE_URL('template/mosto/');?>assets/js/minified.js"></script>
<script src="<?=BASE_URL('template/mosto/');?>assets/js/main.js"></script>
</body>

</html>

<?php  $CMSNT->cong('options', 'value', 1,  " `name` = 'views' "); ?>