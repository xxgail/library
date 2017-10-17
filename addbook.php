<?php

session_start();
include('head.php');
require('dbconnect.php');

if (!isset($_SESSION['Adm'])) {
	echo "管理员没有登录，请";
	echo "<a href=Adminlogin.php>登录\</a>";
	exit();
}

?>
<script type="text/javascript">
	function cheakadd(){
		if (form1.title.value=="") {
			alert("书名不能为空");
			form1.title.focus();
			return false;
		}
		else (form1.author.value=="") {
			alert("作者不能为空");
			form1.author.focus();
			return false;
		}
		else (form1.publisher.value=="") {
			alert("出版社不能为空");
			form1.publisher.focus();
			return false;
		}
		else (form1.publish_year.value=="") {
			alert("出版年份不能为空");
			form1.publish_year.focus();
			return false;
		}
		else (form1.publish_year.value<1000||form1.publish_year.value>3000){
			alert("出版年份不正确");
			form1.publish_year.focus();
			return false;
		}
		else (form1.total.value=="") {
			alert("入库数量不能为空");
			form1.total.focus();
			return false;
		}
		return true;
	}
</script>


<html>
<body>

<form name="form1" method="post" action="addbookOk.php" onsubmit="return checkadd()">
	<table width="50%" border="0" cellpadding="3" cellspacing="1">
		<tr>
			<th colspan="2">新书入库</th>
		</tr>
		<tr>
			<td width="26%" align="right">书名：</td>
			<td width="74%">
				<input type="text" name="title" size="50" maxlength="100">
			</td>
		</tr>
		<tr>
			<td width="26%" align="right">作者：</td>
			<td width="74%">
				<input type="text" name="author" size="50" maxlength="100">
			</td>
		</tr>
		<tr>
			<td width="26%" align="right">出版社：</td>
			<td width="74%">
				<input type="text" name="publisher" size="50" maxlength="100">
			</td>
		</tr>
		<tr>
			<td width="26%" align="right">出版年份</td>
			<td width="74%">
				<input type="text" name="publish_year" size="10" maxlength="10">
			</td>
		</tr>
		<tr>
			<td width="26%" align="right">入库数量</td>
			<td width="74%">
				<input type="text" name="total" size="10" maxlength="10">
			</td>
		</tr>
		<tr>
			<td width="26%" align="right">备注</td>
			<td width="74%">
				<textarea name="other" cols="50"></textarea>
			</td>
		</tr>
		<tr>
			<td width="26%" align="right">
				<input type="submit" name="Submit" value="提交">
			</td>
			<td width="74%">
				<input type="reset" name="Reset" value="重置">
			</td>
		</tr>
	</table>
</form>

</body>
</html>