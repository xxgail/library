<?php
session_start();
include('head.php');
require('dbconnect.php');

//提示用户登录

if (!isset($_SESSION['user'])) {
	// header('Content-type: text/html; charset=UTF8'); 

	echo "<font color=#FF0000 size=5>您还没有登录，请<a href=\"login.php\">登录</a>!</font>";
	exit();
}
?>

<?php
$user_id = $_SESSION['user'];
$sql = "select * from lend where user_id = '$user_id'";
$result = mysql_query($sql,$conn);//执行语句
$num = mysql_num_rows($result);//返回结果集中的行数 

//没有借书则提示用户借书为0
if ($num==0) {
	header('Content-type: text/html; charset=UTF8'); 
	echo '<p align=center><font>您的借书数量为<font color=red>0</font>!</p>'; 

	exit();//输出一个消息并且退出当前脚本
}
echo "<p align=center>您的借书数量为<font color=red>$num</font>!已结书目如下</p>";
echo "<p align='center'>&nbsp;</p>
	  <table border=1 width=80% align='center'><th>书号</th><th>书名</th><th>作者</th><th>出版社</th><th>年份</th><th>借阅时间</th>";

while ($row=mysql_fetch_array($result)) {
	//获得该书的详细信息
	$bsql = "select * from book where id = '$row[book_id]'";
	$bresult = mysql_query($bsql,$conn);
	$binfo = mysql_fetch_array($bresult);//结果集中取得一行作为关联数组，或数字数组，或二者兼有.返回根据从结果集取得的行生成的数组
	echo "<tr><td>$row[book_id]</td>";
	echo "<td>$binfo[title]</td>";
	echo "<td>$binfo[author]</td>";
	echo "<td>$binfo[publisher]</td>";
	echo "<td>$binfo[publish_year]</td>";
	echo "<td>$binfo[lend_time]</td>";
	echo "</tr>";
}
echo "</table>";
?>









