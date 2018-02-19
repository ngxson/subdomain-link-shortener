<?php

	////////// THÔNG SỐ CƠ BẢN (bạn cần sửa theo ý bạn) //////////

	// Domain hoặc subdomain gốc của bạn
	// Ví dụ nếu điền là "ngxson.com" thì bạn sẽ có "link-rut-gon-abc.ngxson.com"
	// nếu điền là "vidu.ngxson.com" thì bạn sẽ có "link-rut-gon-abc.vidu.ngxson.com"
	$GLOBALS['BASE_DOMAIN'] = "localhost";
	
	// Password để đăng nhập vào trang quản lý link
	// Để trống tức là cho phép ai cũng vào được
	$GLOBALS['PWD_MANAGER'] = "nhue123";
	
	// Có cho phép ghi đè lên link cũ hay không
	$GLOBALS['ALLOW_OVERWRITE'] = false;
	
	// Thông số MySQL
	$GLOBALS['MYSQL_PARAMS'] = array(
		'host' => 'localhost',
		'username' => 'nui-link',
		'password' => '123456',
		'database' => 'links'
	);
	
	
	////////// TÙY CHỌN NÂNG CAO (không cần sửa cũng đc) //////////
	
	// Thời lượng session (cho việc đăng nhập trang quản lý), tính bằng giây
	$GLOBALS['SESSION_TIMEOUT'] = 3600;
	
	// Mã secret salt để hash (cho việc đăng nhập trang quản lý)
	// Là 1 chuỗi ký tự ngẫu nhiên, không giới hạn độ dài
	$GLOBALS['SECRET'] = "2Kudz6u16kMLb7SEDy0ahu8DQeXD4UHl3";

?>