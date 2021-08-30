<?php 
    require_once("../../config/config.php");
    require_once("../../config/function.php");
    require_once('../../class/class.smtp.php');
    require_once('../../class/PHPMailerAutoload.php');
    require_once('../../class/class.phpmailer.php');

    if($_POST['type'] == 'Login' )
    {
        $username = check_string($_POST['username']);
        $password = TypePassword(check_string($_POST['password']));
        if(empty($username))
        {
            msg_error2("Vui lòng nhập tên đăng nhập");
        }
        if(!$CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' "))
        {
            msg_error2("Tên đăng nhập không tồn tại trong hệ thống");
        }
        if(empty($password))
        {
            msg_error2("Vui lòng nhập mật khẩu");
        }
        if($CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `banned` = '1' "))
        {
            msg_error2("Tài khoản của bạn đã bị khóa");
        }
        if(!$CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' "))
        {
            msg_error2("Mật khẩu không chính xác");
        }
        if($CMSNT->get_row(" SELECT * FROM `users` WHERE `username` = '$username' AND `level` != 'admin' "))
        {
            msg_error2("Quyền tài khoản này không hợp lệ");
        }
        $CMSNT->update("users", [
            'otp' => NULL
        ], " `username` = '$username' ");
        $_SESSION['username'] = $username;
        
        // GHI LOG
        $file = @fopen('logs/login.txt', 'a');
        if ($file)
        {
            $data = "[".gettime()."] Đăng nhập quản trị thành công ".PHP_EOL;
            fwrite($file, $data);
            fclose($file);
        }
        msg_success('Đăng nhập thành công', BASE_URL('admin'), 0);
    }

