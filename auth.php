<?php

function getPwdHashed() {
	return md5(md5($GLOBALS['SECRET']).$GLOBALS['PWD_MANAGER']);
}

function isAuth() {
	if ($GLOBALS['PWD_MANAGER'] == '') return true;
	else if (!isset($_COOKIE['token'])) return false;
	try {
		$date = new DateTime();
		$token = json_decode($_COOKIE['token'], true);
		$timestamp = $token['timestamp'];
		$signature = md5($timestamp.$GLOBALS['SECRET'].getPwdHashed());
		return ($signature == $token['signature'] &&
			$date->getTimestamp() < ($timestamp + $GLOBALS['SESSION_TIMEOUT']));
	} catch (Exception $e) {
		return false;
	}
}

function generateToken() {
	$date = new DateTime();
	$timestamp = $date->getTimestamp();
	$token = array();
	$token['timestamp'] = $timestamp;
	$token['signature'] = md5($timestamp.$GLOBALS['SECRET'].getPwdHashed());
	return json_encode($token);
}