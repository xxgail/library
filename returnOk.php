<?php

session_start();
include('head.php');
require('dbconnect.php');

if (!isset($_SESSION['Adm'])) {
	echo "<p align='center'>";
	echo "<font color=#FFFF00 size=5><strong><big>";
	echo "管理员没有登录，请 <a href='Adminlogin.php'>登录</a>！";
	echo "</big></strong></font></p>";
	exit();
}

?>

<?php  
$return = $_POST['return'];
$renew = $_POST['renew'];
$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];

if ($return) {
	for ($i=0; $i < count($bookbox); $i++) { 
		if ($bookbox[$i] == "") {
			next;
		}
		else {
			$book_id = $bookbox[$i];
			//在lend表中删除该借书记录
			$returnsql = "delete form lend where book_id = '$book_id' and user_id = '$user_id'";
			mysql_query($returnsql,$conn) or die("删除借书记录失败：".mysql_error());
			//在lend_log表中记录还书时间
			$now = date("Y-m-d");
			$logsql = "update lend_log set return_time = '$now' where book_id = '$book_id' and user_id = '$user_id'";
			mysql_query($logsql,$conn) or die("记录还书时间失败".mysql_error());
			//在book表中增加1本现存书数量
			$booksql = "update book set leave_number = leave_number+1 where id='$book_id'";
			mysql_query($booksql,$conn) or die("增加剩余书数量失败".mysql_error());
			?>
			<p align="center">&nbsp;</p>
			<p align="center">&nbsp;</p>
			<p align="center"><font color="red">还书记录完成！</font></p>
			<?php
		}
	}
}
if ($renew) {
	for ($i=0; $i < count($bookbox); $i++) { 
		if ($bookbox[$i]=="") {
			next;
		}
		else{
			$book_id = $bookbox[$i];
			$now = date("Y-m-d");
			$renewsql = "update lend set renew_time = '$now' where book_id = '$book_id' and user_id = '$user_id'";
			mysql_query($renewsql,$conn) or die("续借失败".mysql_errno());
			?>
			<p align="center">&nbsp;</p>
			<p align="center">&nbsp;</p>
			<p align="center"><font color="red">续借完成！</font></p>
			<?php
		}
	}
}
?>