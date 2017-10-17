<?php

session_start();
header('Content-type:text/html charest=UTF8');
if (isset($_SESSION['Adm'])) {
	//重定向到管理留言
	header("Location:borrow.php");
	exit;
}

$nickname = $_POST['username'];
$password = $_POST['password'];

if ($nickname == "Admin" and $password == "1234") {
	session_register("Adm");
	$Adm = $nickname;

	header("Location:borrow.php");
}
else {
	include("head.php");

header('Content-type:text/html charest=UTF8');
	echo "账号或密码错误，登录失败！";
	//echo </br>;
	echo "<a href='adminlogin.php'>请重试</a>";
}
?>