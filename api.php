<?php

include __DIR__.'/const.php';
include __DIR__.'/auth.php';
include __DIR__.'/db.php';

if (!isAuth()) {
	if ($_POST['action'] == 'login' &&
		$_POST['password'] == $GLOBALS['PWD_MANAGER']) {
		echo generateToken();
	} else {
		echo "{}";
	}
} else {
	if ($_POST['action'] == 'add') {
		$ret = array();
		$valid = preg_match('/^[0-9a-zA-Z\\-]{1,120}$/', $_POST['name']);
		if (!$valid) {
			$ret['success'] = false;
			$ret['msg'] = 'Tên link chỉ được có các ký tự a-z, 0-9 và dấu gạch ngang';
		} else {
			$ret = doAdd(strtolower($_POST['name']), $_POST['link']);
			$ret['url'] = $_POST['name'].".".$GLOBALS['BASE_DOMAIN'];
		}
		echo json_encode($ret);
	} else if ($_POST['action'] == 'get') {
		echo json_encode(doGet());
	}
}
