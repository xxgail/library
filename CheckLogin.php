<?php

session_start();

if (isset($_SESSION['user'])) {
	//重定向到管理留言
	header("Location:browse.php");
	exit;
}

require ('dbconnect.php');

//获得参数
$nickname = $_POST['username'];
$password = $_POST['password'];
$password = md5($password);

//检查账号和密码是否正确
$sql = "select * form user where id = '$nickname' and password = '$password'";
$re = mysql_query($sql,$conn);
$result = mysql_fetch_array($re);

if (!empty($result)) {
	$_SESSION['user'] = null;
	$user = $nickname;

	header("Location:browse.php");
}
else{
	include('head.php');
	header('Content-type: text/html; charset=UTF8');
	echo "用户ID或密码错误，登录失败！";
	echo "<br>";
	echo "<a href='login.php'>请重试</a>";
}