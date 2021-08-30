<?php
class DichvuFacebook {

    //Request
    protected $file_cookie = 'cookie-asj14p214i2109valkehdal5lj21l521l5j.txt';
    protected $cookie = '';

    //Recaptcha
    protected $server_recaptcha = 'http://2captcha.com';
    protected $server_recaptcha_key = 'e12128a1e2a4496085706dde7b2055af'; //Edit
    protected $url_page = 'https://sub.donniechu.cc/login';
    protected $google_key = '6LcEerwZAAAAAIjiTSp4onKeYKgEfmoxYPCGJOhg';
    protected $recaptcha = '';

    public function __construct(){
        //
    }

    public function Login($username, $password){
        //
        $recaptcha = $this->DecodeCaptchaLogin();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=login&username=".$username."&password=".$password."&recaptcha=1&g-recaptcha-response=".$recaptcha);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'Origin: https://sub.donniechu.cc';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Referer: https://sub.donniechu.cc/login';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: ';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $cookie = $this->GetCookieResult($result);
        $this->SaveCookie($cookie);

        if (strpos($result, 'Thông tin đăng nhập không hợp lệ') !== false) {
            return false;
        } else {
            return true;
        }
    }

    //Tăng like theo tháng => ID Profile | Bảo hiểm | Số lượng | Bao nhiêu tháng | Ghi chú
    public function LikeMonth($id_profile, $baohiem, $soluong, $month, $note){
        //
        $cookie = $this->GetCookie();

        if ($baohiem) {
            $cdbh = 1;
            $gtmtt = 2000;
        } else {
            $cdbh = 0;
            $gtmtt = 1900;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/viplike/new?callback=jQuery3210763827136025637_1618505158088');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=save&profile_user=".$id_profile."&cdbh=".$cdbh."&slct=".$soluong."&month=".$month."&gtmtt=".$gtmtt."&notes=".$note);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Origin: https://sub.donniechu.cc';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/viplike/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $results = explode(')', explode('(', $result)[1])[0];
        $json = json_decode($results, true);

        $json_encode = json_encode($json);

        return $json_encode;
    }

    //Lịch sử giao dịch Like Month
    public function HistoryLikeMonth(){
        //
        $cookie = $this->GetCookie();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/viplike');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/viplike/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $row = explode('<tr class="js-list-item">', $result);

        $build = [];
        $dem = 0;

        $tam = 0;

        foreach($row as $x){
            if ($tam > 0) {
                $res = explode('</tr>', $x)[0];
                $fill = explode('<td>', $res);

                $fx = 0;
                $cache2 = 0;
                foreach($fill as $y){
                    if ($cache2 > 0) {
                        $z = explode('</td>', $y)[0];
                        $dt = strip_tags($z);
                        $f = explode("\n", $dt);

                        foreach( $f as $j ){
                            $build[$dem][$fx] = $j;
                            $fx ++;
                        }

                        $fx ++;
                    }
                    $cache2 ++;
                }

                $dem ++;
            }
            $tam ++;
        }

        $fix = [];
        $length = 0;
        $row = 0;

        foreach($build as $x){
            foreach($x as $y){
                if ($y !== ''){

                    $bat = 0;
                    $loop = true;

                    for($i = 0; $i < strlen($y); $i ++){;
                        if ($loop) {
                            if ($y[$i] == ' ') {
                                //echo '+';
                                $bat ++;
                            } else {
                                $loop = false;
                            }
                        }
                    }
                    //exit;
                    //echo $bat.'<br />';
                    $y = substr($y, $bat, strlen($y) - 1);
                    //echo '<hr />';

                    $fix[$length][$row] = $y;
                    $row ++;
                }
            }
            $length ++;
        }

        return $fix;
    }

    //Tăng comment theo tháng => ID Profile | Bảo hiểm | Số lượng | Bao nhiêu tháng | Ghi chú | Hashtag | Comment
    public function CommentMonth($id_profile, $baohiem, $soluong, $month, $note, $hashtag, $comment){
        //
        $cookie = $this->GetCookie();

        if ($baohiem) {
            $cdbh = 1;
            $gtmtt = 20000;
        } else {
            $cdbh = 0;
            $gtmtt = 19000;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/vipcmt/new?callback=jQuery32103095874054657939_1618507227743');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=save&profile_user=".$id_profile."&cdbh=".$cdbh."&slct=".$soluong."&month=".$month."&gtmtt=".$gtmtt."&content=".$comment."&hastag=".$hashtag."&notes=".$note);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Origin: https://sub.donniechu.cc';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/vipcmt/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $results = explode(')', explode('(', $result)[1])[0];
        $json = json_decode($results, true);

        $json_encode = json_encode($json);

        return $json_encode;
    }

    //Lịch sử giao dịch Comment Month
    public function HistoryCommentMonth(){
        //
        $cookie = $this->GetCookie();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/vipcmt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/viplike/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $row = explode('<tr class="js-list-item">', $result);

        $build = [];
        $dem = 0;

        $tam = 0;

        foreach($row as $x){
            if ($tam > 0) {
                $res = explode('</tr>', $x)[0];
                $fill = explode('<td>', $res);

                $fx = 0;
                $cache2 = 0;
                foreach($fill as $y){
                    if ($cache2 > 0) {
                        $z = explode('</td>', $y)[0];
                        $dt = strip_tags($z);
                        $f = explode("\n", $dt);

                        foreach( $f as $j ){
                            $build[$dem][$fx] = $j;
                            $fx ++;
                        }

                        $fx ++;
                    }
                    $cache2 ++;
                }

                $dem ++;
            }
            $tam ++;
        }

        $fix = [];
        $length = 0;
        $row = 0;

        foreach($build as $x){
            foreach($x as $y){
                if ($y !== ''){

                    $bat = 0;
                    $loop = true;

                    for($i = 0; $i < strlen($y); $i ++){;
                        if ($loop) {
                            if ($y[$i] == ' ') {
                                //echo '+';
                                $bat ++;
                            } else {
                                $loop = false;
                            }
                        }
                    }
                    //exit;
                    //echo $bat.'<br />';
                    $y = substr($y, $bat, strlen($y) - 1);
                    //echo '<hr />';

                    $fix[$length][$row] = $y;
                    $row ++;
                }
            }
            $length ++;
        }

        return $fix;
    }

    //Tăng Follow theo tháng => ID Profile | Bảo hiểm | Số lượng | Ghi chú
    public function Follow($id_profile, $baohiem, $soluong, $note){
        //
        $cookie = $this->GetCookie();

        if ($baohiem) {
            $cdbh = 1;
            $gtmtt = 160;
        } else {
            $cdbh = 0;
            $gtmtt = 150;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-sub/new?callback=jQuery321034710614554770247_1618508981221');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=save&profile_user=".$id_profile."&cdbh=".$cdbh."&slct=".$soluong."&gtmtt=".$gtmtt."&notes=".$note);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Origin: https://sub.donniechu.cc';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/vipcmt/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $results = explode(')', explode('(', $result)[1])[0];
        $json = json_decode($results, true);

        $json_encode = json_encode($json);

        return $json_encode;
    }

    //Lịch sử giao dịch Follow
    public function HistoryFollow(){
        //
        $cookie = $this->GetCookie();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-sub');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/viplike/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $row = explode('<tr class="js-list-item">', $result);

        $build = [];
        $dem = 0;

        $tam = 0;

        foreach($row as $x){
            if ($tam > 0) {
                $res = explode('</tr>', $x)[0];
                $fill = explode('<td>', $res);

                $fx = 0;
                $cache2 = 0;
                foreach($fill as $y){
                    if ($cache2 > 0) {
                        $z = explode('</td>', $y)[0];
                        $dt = strip_tags($z);
                        $f = explode("\n", $dt);

                        foreach( $f as $j ){
                            $build[$dem][$fx] = $j;
                            $fx ++;
                        }

                        $fx ++;
                    }
                    $cache2 ++;
                }

                $dem ++;
            }
            $tam ++;
        }

        $fix = [];
        $length = 0;
        $row = 0;

        foreach($build as $x){
            foreach($x as $y){
                if ($y !== ''){

                    $bat = 0;
                    $loop = true;

                    for($i = 0; $i < strlen($y); $i ++){;
                        if ($loop) {
                            if ($y[$i] == ' ') {
                                //echo '+';
                                $bat ++;
                            } else {
                                $loop = false;
                            }
                        }
                    }
                    //exit;
                    //echo $bat.'<br />';
                    $y = substr($y, $bat, strlen($y) - 1);
                    //echo '<hr />';

                    $fix[$length][$row] = $y;
                    $row ++;
                }
            }
            $length ++;
        }

        return $fix;
    }

    //Tăng like bài viết => ID bài viết | Bảo hiểm | Số lượng | Ghi chú
    public function LikePost($id_profile, $baohiem, $soluong, $note){
        //
        $cookie = $this->GetCookie();

        if ($baohiem) {
            $cdbh = 1;
            $gtmtt = 220;
        } else {
            $cdbh = 0;
            $gtmtt = 200;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-like/new?callback=jQuery321041942019333259317_1618508950768');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=save&profile_user=".$id_profile."&cdbh=".$cdbh."&slct=".$soluong."&gtmtt=".$gtmtt."&notes=".$note);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Origin: https://sub.donniechu.cc';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/vipcmt/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $results = explode(')', explode('(', $result)[1])[0];
        $json = json_decode($results, true);

        $json_encode = json_encode($json);

        return $json_encode;
    }

    //Lịch sử giao dịch Like bài viết
    public function HistoryLikePost(){
        //
        $cookie = $this->GetCookie();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-like');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/viplike/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $row = explode('<tr class="js-list-item">', $result);

        $build = [];
        $dem = 0;

        $tam = 0;

        foreach($row as $x){
            if ($tam > 0) {
                $res = explode('</tr>', $x)[0];
                $fill = explode('<td>', $res);

                $fx = 0;
                $cache2 = 0;
                foreach($fill as $y){
                    if ($cache2 > 0) {
                        $z = explode('</td>', $y)[0];
                        $dt = strip_tags($z);
                        $f = explode("\n", $dt);

                        foreach( $f as $j ){
                            $build[$dem][$fx] = $j;
                            $fx ++;
                        }

                        $fx ++;
                    }
                    $cache2 ++;
                }

                $dem ++;
            }
            $tam ++;
        }

        $fix = [];
        $length = 0;
        $row = 0;

        foreach($build as $x){
            foreach($x as $y){
                if ($y !== ''){

                    $bat = 0;
                    $loop = true;

                    for($i = 0; $i < strlen($y); $i ++){;
                        if ($loop) {
                            if ($y[$i] == ' ') {
                                //echo '+';
                                $bat ++;
                            } else {
                                $loop = false;
                            }
                        }
                    }
                    //exit;
                    //echo $bat.'<br />';
                    $y = substr($y, $bat, strlen($y) - 1);
                    //echo '<hr />';

                    $fix[$length][$row] = $y;
                    $row ++;
                }
            }
            $length ++;
        }

        return $fix;
    }

    //Tăng like fanpage => ID Fanpage | Bảo hiểm | Số lượng | Ghi chú
    public function FollowFanpage($id_profile, $baohiem, $soluong, $note){
        //
        $cookie = $this->GetCookie();

        if ($baohiem) {
            $cdbh = 1;
            $gtmtt = 160;
        } else {
            $cdbh = 0;
            $gtmtt = 150;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-like-page/new?callback=jQuery32105546977053091058_1618509339796');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=save&profile_user=".$id_profile."&cdbh=".$cdbh."&slct=".$soluong."&gtmtt=".$gtmtt."&notes=".$note);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Origin: https://sub.donniechu.cc';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/vipcmt/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $results = explode(')', explode('(', $result)[1])[0];
        $json = json_decode($results, true);

        $json_encode = json_encode($json);

        return $json_encode;
    }

    //Lịch sử giao dịch Follow Fanpage
    public function HistoryFollowFanpage(){
        //
        $cookie = $this->GetCookie();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-like');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/viplike/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $row = explode('<tr class="js-list-item">', $result);

        $build = [];
        $dem = 0;

        $tam = 0;

        foreach($row as $x){
            if ($tam > 0) {
                $res = explode('</tr>', $x)[0];
                $fill = explode('<td>', $res);

                $fx = 0;
                $cache2 = 0;
                foreach($fill as $y){
                    if ($cache2 > 0) {
                        $z = explode('</td>', $y)[0];
                        $dt = strip_tags($z);
                        $f = explode("\n", $dt);

                        foreach( $f as $j ){
                            $build[$dem][$fx] = $j;
                            $fx ++;
                        }

                        $fx ++;
                    }
                    $cache2 ++;
                }

                $dem ++;
            }
            $tam ++;
        }

        $fix = [];
        $length = 0;
        $row = 0;

        foreach($build as $x){
            foreach($x as $y){
                if ($y !== ''){

                    $bat = 0;
                    $loop = true;

                    for($i = 0; $i < strlen($y); $i ++){;
                        if ($loop) {
                            if ($y[$i] == ' ') {
                                //echo '+';
                                $bat ++;
                            } else {
                                $loop = false;
                            }
                        }
                    }
                    //exit;
                    //echo $bat.'<br />';
                    $y = substr($y, $bat, strlen($y) - 1);
                    //echo '<hr />';

                    $fix[$length][$row] = $y;
                    $row ++;
                }
            }
            $length ++;
        }

        return $fix;
    }
    //Tăng cmt bài viết
    public function CommentStatus($id_profile, $baohiem, $soluong, $comment, $note){
        //
        $cookie = $this->GetCookie();

        if ($baohiem) {
            $cdbh = 1;
            $gtmtt = 100;
        } else {
            $cdbh = 0;
            $gtmtt = 95;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-like-page/new?callback=jQuery32105546977053091058_1618509339796');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, "action=save&profile_user=".$id_profile."&cdbh=".$cdbh."&slct=".$soluong."&gtmtt=".$gtmtt."&content=".$comment."&notes=".$note);

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01';
        $headers[] = 'X-Requested-With: XMLHttpRequest';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
        $headers[] = 'Origin: https://sub.donniechu.cc';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: cors';
        $headers[] = 'Sec-Fetch-Dest: empty';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/vipcmt/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $results = explode(')', explode('(', $result)[1])[0];
        $json = json_decode($results, true);

        $json_encode = json_encode($json);

        return $json_encode;
    }

    //Lịch sử giao dịch Comment bài viết
    public function HistoryCommentStatus(){
        //
        $cookie = $this->GetCookie();
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://sub.donniechu.cc/facebook/buzz-cmt');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Authority: sub.donniechu.cc';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/94.0.202 Chrome/88.0.4324.202 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Sec-Fetch-Site: same-origin';
        $headers[] = 'Sec-Fetch-Mode: navigate';
        $headers[] = 'Sec-Fetch-User: ?1';
        $headers[] = 'Sec-Fetch-Dest: document';
        $headers[] = 'Referer: https://sub.donniechu.cc/facebook/viplike/new';
        $headers[] = 'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
        $headers[] = 'Cookie: '.$cookie;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $row = explode('<tr class="js-list-item">', $result);

        $build = [];
        $dem = 0;

        $tam = 0;

        foreach($row as $x){
            if ($tam > 0) {
                $res = explode('</tr>', $x)[0];
                $fill = explode('<td>', $res);

                $fx = 0;
                $cache2 = 0;
                foreach($fill as $y){
                    if ($cache2 > 0) {
                        $z = explode('</td>', $y)[0];
                        $dt = strip_tags($z);
                        $f = explode("\n", $dt);

                        foreach( $f as $j ){
                            $build[$dem][$fx] = $j;
                            $fx ++;
                        }

                        $fx ++;
                    }
                    $cache2 ++;
                }

                $dem ++;
            }
            $tam ++;
        }

        $fix = [];
        $length = 0;
        $row = 0;

        foreach($build as $x){
            foreach($x as $y){
                if ($y !== ''){

                    $bat = 0;
                    $loop = true;

                    for($i = 0; $i < strlen($y); $i ++){;
                        if ($loop) {
                            if ($y[$i] == ' ') {
                                //echo '+';
                                $bat ++;
                            } else {
                                $loop = false;
                            }
                        }
                    }
                    //exit;
                    //echo $bat.'<br />';
                    $y = substr($y, $bat, strlen($y) - 1);
                    //echo '<hr />';

                    $fix[$length][$row] = $y;
                    $row ++;
                }
            }
            $length ++;
        }

        return $fix;
    }

    protected function GetCookie(){
        //
        $myfile = fopen($this->file_cookie, "r") or die("Cookie không tồn tại!");
        $content = fgets($myfile);
        fclose($myfile);

        return $content;
    }

    protected function SaveCookie($cookie){
        //
        $myfile = fopen($this->file_cookie, "w") or die("Unable to open file!");
        $txt = $cookie;
        fwrite($myfile, $txt);
        fclose($myfile);
    }

    protected function DecodeCaptchaLogin(){
        $url = $this->server_recaptcha.'/in.php?key='.$this->server_recaptcha_key.'&method=userrecaptcha&googlekey='.$this->google_key.'&pageurl='.$this->url_page;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Cache-Control: max-age=0';
        $headers[] = 'Upgrade-Insecure-Requests: 1';
        $headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36';
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
        $headers[] = 'Accept-Language: en-US,en;q=0.9';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $x = explode('|', $result);

        if ($result == 'ERROR_ZERO_BALANCE') {
            $build = [
                'status' => false,
                'message' => 'Bạn không đủ tiền giải recaptcha',
            ];

            $this->error = $build;

            exit(json_encode($build));
        }

        $get = 'CAPCHA_NOT_READY';

        while ($get == 'CAPCHA_NOT_READY') {
            $url = $this->server_recaptcha.'/res.php?key='.$this->server_recaptcha_key.'&action=get&id='.$x[1];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

            curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

            $headers = array();
            $headers[] = 'Connection: keep-alive';
            $headers[] = 'Cache-Control: max-age=0';
            $headers[] = 'Upgrade-Insecure-Requests: 1';
            $headers[] = 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36';
            $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
            $headers[] = 'Accept-Language: en-US,en;q=0.9';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            $get = $result;
        }

        $v = explode('|', $get)[1] ?? '';

        return $this->recaptcha = $v;            
    }

    protected function GetCookieResult($result){
        $cookie = '';
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
        foreach($matches[1] as $x) {
            $cookie .= $x.';';
        }
        $this->cookie = $cookie = substr($cookie, 0, strlen($cookie) - 1);        
        return $this->cookie;
    }

}