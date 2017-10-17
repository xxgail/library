<?php
header("Content-type:text/html charset=utf-8");
include("head.php");
?>

<script type="text/javascript">
	function checklog(){
		if (form1.name.value="") {
			alter("用户名不能为空！");
			form1.name.focus();
			return false;
		}
		else if(form1.password.value=""){
			alter("密码不能为空");
			form1.password.focus();
			return false;
		}
		else if(form1.pwd.value=""){
			alter("确认密码不能为空");
			form1.pwd.focus();
			return false;
		}
		else if(form1.pwd.value!=form1.password.value){
			alter("必须与密码一致");
			form1.pwd.focus();
			return false;
		}
		else if(form1.Email.value=""){
			alter("Email不能为空");
			form1.Email.focus();
			return false;
		}else if(form1.Email.value.charAt(0)=="."||
			form1.Email.value.charAt(0)=="@"||
			form1.Email.value.indexOf('@',0)==-1||
			form1.Email.value.indexOf('.',0)==-1||
			form1.Email.value.lastIndexOf("@")==form1.Email.value.length-1||
			form1.Email.value.lastIndexOf(".")==form1.Email.value.length-1
			){
			alter("Email格式不正确");
			form1.Email.focus();
			return false;

		}
		return true;
	}
</script>



<html>
<meta charset="utf-8">
<body>
<form name="form1" method="post" action="regOk.php" enctype="multipart/form-data" onsubmit="return checklog()">
<table align="center" border="0" width="100%" cellpadding="1">
	<tr>
		<td>用户名：</td>
		<td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td>密码：</td>
		<td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td>确认密码：</td>
		<td><input type="password" name="pwd"></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="text" name="Email"></td>
	</tr>
	<tr>
		<td>电话：</td>
		<td><input type="text" name="tel"></td>
	</tr>
	<tr>
		<td>地址：</td>
		<td><input type="text" name="address"></td>
	</tr>
	<tr>
		<td><input type="submit" name="submit1" value="注册"></td>
		<td><input type="submit" name="submit2" value="清空"></td>
	</tr>
</table>
</form>

</body>
</html>