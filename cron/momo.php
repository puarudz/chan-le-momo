<?php
    require_once("../config/config.php");
    require_once("../config/function.php");
    require_once("../config/chanle.php");

    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if(getSite('token-momo') == '')
    {
        // GHI LOG
        $file = @fopen('../logs/cron.txt', 'a');
        if ($file)
        {
            $data = "[CRON-JOBS] Vui lòng nhập TOKEN MOMO vào hệ thống | ".gettime().PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        die('Vui lòng nhập TOKEN MOMO vào hệ thống');
    }
    if(getSite('status') == 'OFF')
    {
        // GHI LOG
        $file = @fopen('../logs/cron.txt', 'a');
        if ($file)
        {
            $data = "[CRON-JOBS] Hệ thống đang bảo trì không thể xử lý giao dịch | ".gettime().PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        die('Hệ thống đang bảo trì không thể xử lý giao dịch.');
    }
    
    transfer_momo();

    if(getSite('status_hoan_tien_chan_le') == 'ON')
    {
        refund_momo();
    }

    processing_momo();

    transfer_momo();

    if(getSite('status_hoan_tien_chan_le') == 'ON')
    {
        refund_momo();
    }

    // GHI LOG
    $file = @fopen('../logs/cron.txt', 'a');
    if ($file)
    {
        $data = "[CRON-JOBS] Cron hoàn tất vào lúc ".gettime().PHP_EOL;
        fwrite($file, $data);
        fclose($file);
    }