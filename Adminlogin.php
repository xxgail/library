<?php 

session_start();
header('Content-type: text/html; charset=UTF8'); 
if (isset($_SESSION['Adm'])){
	//重定向到管理留言
	header("Location:borrow.php");
	exit;
}

include("head.php")
 ?>

 <script type="javascript">
 	function checklogin(){
 		

 		if ((login.username.value!="")&&(login.password.value!="")) {

 			return true
 		} else{
 			// alert("用户名和密码不能为空")
 			alert(login.username.value);
 			return false
 		}
 	}
 </script>

 <form action="CheckAdmLogin.php" method="post" name="login" onsubmit="return checklogin()">
 	<p align="center">管理员登录</p>
 	<table align="center" border="0">
 		<tr>
 			<th>管理员：</th>
 			<th><input type="text" name="username"></th>
 		</tr>
 		<tr>
 			<th>密码：</th>
 			<th><input type="password" name="password"></th>
 		</tr>
</table>

 		<p align="center"><input type="submit" name="登录"></p>

 
 </form>