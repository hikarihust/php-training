<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Process</title>
</head>
<body>
	<div id="wrapper">
    	<div class="title">Process</div>
        <div id="form">   
			<?php
				require_once 'functions.php';
				if (isset($_COOKIE['fullName']) && $_COOKIE['fullName']) {
					echo '<h3>Xin chào cookie: ' . $_COOKIE['fullName'] . '</h3>';
					echo '<a href="logout.php">Đăng xuất</a>';
				} else {
					if (!checkEmpty($_POST['username']) && !checkEmpty($_POST['password'])) {
						$userName = $_POST['username'];
						$passWord = md5($_POST['password']);
						$data 	  = parse_ini_file('users.ini');
						$userInfo = explode('|', $data[$userName]);

						if ($userInfo[0] === $userName && $userInfo[1] === $passWord) {
							setcookie('fullName', $userInfo[2], time() + 20);
							echo '<h3>Xin chào: ' . $userInfo[2] . '</h3>';
							echo '<a href="logout.php">Đăng xuất</a>';
						} else {
							header('location: login.php');
						}
					} else {
						header('location: login.php');
					}
				}
			?>  
        </div>
    </div>
</body>
</html>
