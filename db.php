<?php

$servername = $GLOBALS['MYSQL_PARAMS']['host'];
$dbname = $GLOBALS['MYSQL_PARAMS']['database'];
$GLOBALS['nui_conn'] = new PDO("mysql:host=$servername;dbname=$dbname",
	$GLOBALS['MYSQL_PARAMS']['username'],
	$GLOBALS['MYSQL_PARAMS']['password']);
	
$GLOBALS['nui_conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function doAdd($name, $link) {
	$sql = "INSERT INTO links (timestamp, name, link) VALUES (NOW(),:name,:link)";
	if ($GLOBALS['ALLOW_OVERWRITE']) {
		$sql .= " ON DUPLICATE KEY UPDATE link=VALUES(link),timestamp=VALUES(tempstamp)";
	}
	$stmt = $GLOBALS['nui_conn']->prepare($sql);
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':link', $link);
	$ret = array();
	try {
		$stmt->execute();
		$ret['success'] = true;
		$ret['url'] = $name.".".$GLOBALS['BASE_DOMAIN'] ;
	} catch (PDOException $e) {
		$ret['success'] = false;
		$ret['msg'] = $e->getMessage();
	}
	return $ret;
}

function doGet() {
	$sql = "SELECT name,link,count FROM links ORDER BY timestamp DESC";
	$stmt = $GLOBALS['nui_conn']->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}

function doLinkLookup($name) {
	$sql = "SELECT link FROM links WHERE `name`=:name ; UPDATE links SET count=count+1 WHERE name=:name"; 
	try {
		$stmt = $GLOBALS['nui_conn']->prepare($sql);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
}
