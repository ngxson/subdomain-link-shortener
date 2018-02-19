# Subdomain Link Shortener

[![N|Nui](https://raw.githubusercontent.com/ngxson/subdomain-link-shortener/master/cover.jpg)]()

# Tính năng

- Ngôn ngữ php
- Rút gọn link thành subdomain
- Có giao diện điều khiển
- Có đếm số lượt truy cập/link
- Có bug (nhưng chưa tìm ra)

# Yêu cầu

- Có host php/mysql
- Có domain hoặc subdomain riêng đang trỏ về host trên

# Hướng dẫn

1. Tạo MySQL database mới, import file trong `import_me_via_phpmyadmin` lên database vừa tạo
2. Sửa file const.php. Ở đây mình ví dụ là mình muốn tạo link kiểu `link-rut-gon-abc.vidu.ngxson.com`
3. Upload code lên server
4. Tạo subdomain `*.vidu.ngxson.com` và `vidu.ngxson.com` trỏ về thư mục code vừa upload
5. Nếu bạn dùng DNS ngoài, bạn cần tạo record `*.vidu.ngxson.com` và `vidu.ngxson.com` trỏ về server của bạn (dùng A hoặc CNAME)
6. Mở `http://vidu.ngxson.com` lên và thưởng thức

Source code mình thiết kế cho mục đích cá nhân/CLB nhỏ lẻ là chính nên còn khá nhiều thiếu sót, mong anh em thông cảm bằng cách tạo issue hoặc pull request ;)

# Author

- ngxson (Nui)
- Visit my [website](https://ngxson.com) or my [github](https://github.com/ngxson)