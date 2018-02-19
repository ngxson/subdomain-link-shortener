<?php

include __DIR__.'/const.php';
include __DIR__.'/auth.php';
include __DIR__.'/db.php';

$GLOBALS['MODE'] = 'REDIRECT';
if ($_SERVER['SERVER_NAME'] == strtolower("manager.".$GLOBALS['BASE_DOMAIN']) ) {
	$GLOBALS['is_auth'] = isAuth();
	if ($is_auth) {
		$GLOBALS['MODE'] = 'MANAGER';
	} else {
		$GLOBALS['MODE'] = 'LOGIN';
	}
} else {
	$rdrname = str_replace(".".strtolower($GLOBALS['BASE_DOMAIN']), "", $_SERVER['SERVER_NAME']);
	$rdrname = strtolower($rdrname);
	$rdrlink_temp = doLinkLookup($rdrname);
	//var_dump($rdrlink_temp[0]['link']);
	if (count($rdrlink_temp) < 1) {
		$GLOBALS['MODE'] = 'NOTFOUND';
	} else {
		header('Location: '.$rdrlink_temp[0]['link']);
		exit;
	}
}

?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Rút gọn link - <?php echo $GLOBALS['BASE_DOMAIN']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-diamond"></span>
						</div>
						<div class="content">
							<div class="inner">
							<?php if ($GLOBALS['MODE'] == 'NOTFOUND') { ?>
								<h1>Không tìm thấy nội dung này :(</h1>
							<?php } else { ?>
								<h1><?php echo $GLOBALS['BASE_DOMAIN']; ?></h1>
								<p>Hệ thống rút gọn link hiện đại nhất nhì Đông Dương</p>
							<?php } ?>
							</div>
						</div>
						<nav>
							<ul>
							<?php if ($GLOBALS['MODE'] == 'MANAGER') { ?>
								<li><a href="#list">Danh sách</a></li>
								<li><a href="#add">Thêm mới</a></li>
								<li><a href="javascript:doLogout();">Đăng xuất</a></li>
							<?php } else if ($GLOBALS['MODE'] == 'LOGIN') { ?>
								<li><a href="#login">Đăng nhập</a></li>
							<?php } else { ?>
								<li><a href="javascript:window.history.back();">Quay lại</a></li>
							<?php } ?>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Login -->
							<article id="login">
								<h2 class="major">Đăng nhập</h2>
								<form id="form-login">
									<input type="hidden" name="action" value="login"></input>
									<div class="field">
										<label for="password">Mật khẩu</label>
										<input type="password" name="password" id="password"></input>
									</div>
									<ul class="actions">
										<li><input type="button" value="Đăng nhập" class="special" onclick="doLogin();"/></li>
									</ul>
								</form>
							</article>
							
						<!-- Loading -->
							<article id="loading">
								<h2 class="major">Xin chờ...</h2>
								<p id=""></p>
							</article>
<?php if ($GLOBALS['MODE'] == 'MANAGER') { ?>
						<!-- List -->
							<article id="list">
								<h2 class="major">Danh sách link</h2>
								<div id="list-html">
								</div>
							</article>
							
						<!-- Add -->
							<article id="add">
								<h2 class="major">Thêm link mới</h2>
								<form id="form-add">
									<input type="hidden" name="action" value="add"></input>
									<div class="field">
										<label for="message">Link gốc</label>
										<textarea name="link" id="link"></textarea>
									</div>
									<div class="field">
										<label for="message">Tên link rút gọn (....<?php echo $GLOBALS['BASE_DOMAIN']; ?>)</label>
										<textarea name="name" id="name"></textarea>
									</div>
									<ul class="actions">
										<li><input type="button" value="Thêm" class="special" onclick="doAdd();"/></li>
									</ul>
								</form>
							</article>
							
					<!-- Add Success -->
							<article id="add-success">
								<h2 class="major">Thành công!</h2>
								<form>
									<div class="field">
										<label for="message">Link của bạn:</label>
										<textarea id="link-success"></textarea>
									</div>
									<ul class="actions">
										<li><input type="button" value="Copy" class="special" onclick="copySuccess();"/></li>
									</ul>
								</form>
							</article>
<?php } ?>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<!--p class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</p-->
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script>
				var nui_main;
				var nui_base_domain = <?php echo json_encode($GLOBALS['BASE_DOMAIN']); ?>;
			</script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/nui.js"></script>

	</body>
</html>
