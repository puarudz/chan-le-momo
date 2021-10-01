# Installation
* C0nfIg nằm trong ```config/config.php```
## Config cơ sở dữ liệu
```php
if (!$this->ketnoi)
        {
            $this->ketnoi = mysqli_connect('localhost', 'root', '', 'chanlemomo') or die ('Vui lòng kết nối đến DATABASE');
            mysqli_query($this->ketnoi, "set names 'utf8'");
        }
    }
````
* Các bạn config theo thứ tự ```'host', 'username', 'password', 'dbname'```
## Config domain
```php
$base_url = 'http://localhost/CMSNT/CHANLEMOMO/'; // Thay url web bạn
```
# Code của CMSNT.CO - TEaM leADEr Nguyễn Thành
### Vui lòng không sử dụng vào việc KINH DOANH CỜ BẠC BẤT HỢP PHÁP
### Mình sẽ không chịu trách nhiệm nếu các bạn vi phạm các quy định sử dụng code sau đây:
* Sử mã nguồn để thực hiện các hành vi vi phạm pháp luật của Nhà nước CHXHCN Việt Nam hiện hành và các quy định quốc tế đang được áp dụng tại Việt Nam.
* Sử mã nguồn để truyền bá các nội dung nhạy cảm, văn hóa phẩm đồi trụy, ảnh hưởng đến thuần phong mỹ tục Việt Nam.
* Phát tán và lưu trữ các loại mã độc nhằm mục đích tấn công website khác, hoặc mục đích phá hoại hệ thống của FUTE như Botnet, DDoS, Malware, Virus, Phishing. Bao gồm trường hợp website chứa mã độc.

# Liên hệ 
* Email: refresh.official@protonmail.
