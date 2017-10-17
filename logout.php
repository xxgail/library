<?php
session_start();

session_unset();
session_destroy();
include('head.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>注销登录</title>
</head>
<body>
<p align="center">已成功注销登录。</p>
<p align="center"><a href="login.php">重新登录</a></p>
</body>
</html>