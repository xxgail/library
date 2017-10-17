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

<script type="text/javascript">
	function checkall(form){
		//alert(form.selectall.value);
		for (var i=0;i<form.element.length;i++){
			var e = form.elements[i];
			if (e.type == "checkbox") {
				e.checked = true;
			}
			if (e.name == "selecttype") {
				e.checked = false;
			}
		}
	}
</script>


<html>
<body>
<?php
if ($show=="") {
?>
<form name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
	<table width="60%" border="0" cellpadding="3" cellspacing="1" align="center">
		<tr>
			<th colspan="2">还书和续借登记</th>
		</tr>
		<tr>
			<td width="30%" height="32" align="center">图书信息</td>
			<td width="70%" height="32">
				<input type="text" name="user_id" size="10">
				<input type="submit" name="show" value="显示该用户借书信息">
			</td>
		</tr>
	</table>
</form>
<?php
}
else {
	if ($show) {
		if ($user_id == "") {
			echo "<div align=center><font color=red>用户编号没有填写！</font></div>";
			exit();
		}
		else{
			$sql = "select * form lend where user_id='$user_id'";
			$result = mysql_query($sql,$conn);
			$num = mysql_num_rows($result);

			if ($num == 0) {
				echo "<p align=center>您的借书数量为<font color=red>0</font></p>";
				exit();
			}
			
			echo "<p align='center'>您的借书数量为<font color='red'>$num</font>!借书数目如下：</p>";
			echo "<p align='center'>&nbsp;</p>";
			echo "<form name='form2' method='post' action='returnOk.php'>";
			echo "<input type='radio' name='selecttype' value='selected'>";
			echo "选中要归还或续借的文献";

			echo "<input type='radio' name='selectall' value='1' onclick='checkall(this.form)'>";
			echo "全部选中<p>";
			echo "<input type='hidden' name='book_id' value='$book_id'>";
			echo "<input type='hidden' name='user_id' value='$user_id'>";
			echo "<table border='1' width='100%' align='center'>";
			echo "<th>&nbsp;</th>";
			echo "<th>书号</th>";
			echo "<th>书名</th>";
			echo "<th>作者</th>";
			echo "<th>出版社</th>";
			echo "<th>年份</th>";
			echo "<th>借阅时间</th>";
			while ($row = mysql_fetch_array($result)) {
				$bsql = "select * form book where id = '$row[book_id]'";
				$bresult = mysql_query($bsql,$conn);
				$binfo = mysql_fetch_array($bresult);
				echo "<tr><td><input type='checkbox' name='checkbox' value='$row[book_id]'></td>";
				echo "<td>$row[book_id]</td>";
				echo "<td>$binfo[title]</td>";
				echo "<td>$binfo[author]</td>";
				echo "<td>$binfo[publisher]</td>";
				echo "<td>$binfo[publish_year]</td>";
				echo "<td>$row[lend_time]</td>";
				echo "</tr>";
			}
?>
			</table>
			</form>
			<p align="center">&nbsp;</p>
			<table align="center" width="50%">
				<tr>
					<td align="center">
						<input type="submit" name="return" value="还书">
					</td>
					<td align="center">
						<input type="submit" name="renew" value="续借">
					</td>
				</tr>
			</table>
<?php  
		}
	}
}
?>
</body>
</html>