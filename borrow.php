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

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<body>

<?php
if ($show=="" and $lend=="") {
?>
<form name="form1" method="post" action="<?php echo $PHP_SELF;?>">
	<table align="center" width="60%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<th colspan="2">借书登记</th>
		</tr>
		<tr>
			<td align="right" width="30%" height="32">图书编号：</td>
			<td width="70%" height="32">
				<input type="text" name="book_id" size="10">
				<input type="submit" name="show" value="显示该书信息">
			</td>
		</tr>
	</table>
</form>
<?php
}

else{
	//只是显示图书详细信息
	if ($show) {
		if ($book_id=="") {
		echo "<div align=center><font color=red>图书编号没有填写！</font></div>";
		exit();
		}
		else{
			$booksql = "select * form book where id = $book_id";
			$bookresult = mysql_query($booksql,$conn);
			$bookinfo = mysql_fetch_array($bookresult);

			if (empty($bookinfo)) {
				echo "<div align=center><font color=red> 不存在该图书编号！</font></div>";
				exit();
			}
			else{
				if ($bookinfo['leave_number']=="0") {
					echo "<div align=center><font color=red>该图书已全部借完！</font></div>";

				}

?>

	<form name="form1" method="post" action="<?php echo $PHP_SELF;?>">
	<table align="center" width="60%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<th colspan="2">借书登记</th>
		</tr>
		<tr>
			<td align="right" width="30%" height="32">图书编号：</td>
			<td width="70%" height="32">
			<?php echo $book_id; ?>
			<input type="hidden" name="book_id" value="<?php echo $bookinfo[id]; ?>">
			<input type="hidden" name="title" value="<? echo $bookinfo[title]; ?>">
			<input type="hidden" name="leave" value="<? echo $bookinfo[leave_number];?>">
			</td>
		</tr>
		<tr>
			<td width="30%" align="right">书名：</td>
			<td width="70%"><?php echo $bookinfo[title]; ?></td>
		</tr>
		<tr>
			<td width="30%" align="right">作者：</td>
			<td width="70%"><?php echo $bookinfo[author]; ?></td>
		</tr>
		<tr>
			<td width="30%" align="right">出版社：</td>
			<td width="70%"><?php echo $bookinfo[publisher]; ?></td>
		</tr>
		<tr>
			<td width="30%" align="right">出版年份：</td>
			<td width="70%"><?php echo $bookinfo[publish_year]; ?></td>
		</tr>
		<tr>
			<td height="23" align="right">总共：<? echo $bookinfo[total]; ?>本;</td>
			<td height="23">库存剩余：<?php echo $bookinfo[leave_number]; ?>本</td>
		</tr>
		<tr>
			<td width="30%" align="right">借阅用户ID：</td>
			<td width="70%">
				<input type="text" name="user_id" size="10">
			</td>
		</tr>
		<tr>
			<td width="30%" align="right">
				<input type="submit" name="lend" value="借出">
			</td>
			<td width="70%">
				<input type="reset" name="Submit2" value="重置">
			</td>
		</tr>

	</table>
</form>

<?php
			}

		}
	}
	//借书
	if($lend){
		if ($user_id=="") {
			echo '<div align=center><font color=red>用户ID没有填写！</font></div>';
			exit();

		}
		//记录正常借书
		$now = date("Y-m-d");
		$lendsql = "insert into lend(book_id,book_title,lend_time,user_id) value('$book_id','$title','$now','$user_id')";
		mysql_query($lendsql,$conn) or die("操作失败".mysql_error());
		//在log中记录
		$logsql = "insert into lend_log(book_id,user_id,lend_time) value('$book_id','user_id','$now')";
		mysql_query($logsql,$conn) or die("操作失败".mysql_error());

		$leave_num = $leave-1;
		mysql_query("update book set leave_number = 'leave_num' where id='$book_id'",$conn);
?>
		<p align="center">&nbsp;</p>
		<p align="center">&nbsp;</p>
		<p align="center"><font color="red">借阅登记完成！</font></p>
		<p align="center"><a href="<?php echo $PHP_SELF; ?>">继续添加</a></p>
<?php 
	}

}
 ?>
</body>
</html>