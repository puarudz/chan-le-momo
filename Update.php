<?php
    require_once(__DIR__."/config/config.php");
    require_once(__DIR__."/config/function.php");

    // CHÚ THÍCH TÁC DỤNG ĐỂ CÁC SHOP YÊN TÂM SỬ DỤNG HƠN NHÉ
    if(getSite('status_demo') == 'ON')
    {
        msg_warning2("Chức năng này không khả dụng trên trang web DEMO!");
    }
    if($getUser['level'] == 'admin')
    {
        //CONFIG THÔNG SỐ
        define('filename', 'update_'.random('ABC123456789', 6).'.zip');
        define('serverfile', 'http://api.cmsnt.co/CHANLEMOMO.zip');
        
        // TIẾN HÀNH TẢI BẢN CẬP NHẬT TỪ SERVER VỀ 
        file_put_contents(filename, file_get_contents(serverfile));

        // TIẾN HÀNH GIẢI NÉN BẢN CẬP NHẬT VÀ GHI ĐÈ VÀO HỆ THỐNG
        $file = filename;
        $path = pathinfo(realpath($file), PATHINFO_DIRNAME);
        $zip = new ZipArchive;
        $res = $zip->open($file);
        if ($res === TRUE)
        {
            $zip->extractTo($path);
            $zip->close();

            // XÓA FILE ZIP CẬP NHẬT TRÁNH TỤI KHÔNG MUA ĐÒI XÀI FREE
            unlink(filename);

            // TIẾN HÀNH INSTALL DATABASE MỚI
            $query = file_get_contents(BASE_URL('install.php'));

            // XÓA FILE INSTALL DATABASE
            unlink('install.php');

            // GHI LOG
            $file = @fopen('logs/update.txt', 'a');
            if ($file)
            {
                $data = "[".gettime()."] Tải bản cập nhật thành công ".PHP_EOL;
                fwrite($file, $data);
                fclose($file);
            }

            msg_success2("Tải bản cập nhật thành công");
        }
        else
        {
            // GHI LOG
            $file = @fopen('logs/update.txt', 'a');
            if ($file)
            {
                $data = "[".gettime()."] Tải bản cập nhật thất bại ".PHP_EOL;
                fwrite($file, $data);
                fclose($file);
            }
            msg_error2("Tải bản cập nhật thất bại");
        }
    }