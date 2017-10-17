<?

session_start();

if (isset($_SESSION['user'])) {
	//重定向到管理留言
	header("Location:browse.php");
	exit;
}

include('head.php');

?>

<script type="text/javascript">
	function checklogin(){
 		if ((login.username.value!="")&&(login.password.value=!"")) {
 			return true
 		}
 		else{
 			alert("用户名和密码不能为空")
 			return false
 		}
 	}
</script>

<form action="CheckLogin.php" method="post" name="login" onsubmit="return checklogin()">
 	<p align="center">用户登录</p>
 	<table align="center" border="0">
 		<tr>
 			<th>用户ID：</th>
 			<th><input type="text" name="username"></th>
 		</tr>
 		<tr>
 			<th>密码：</th>
 			<th><input type="password" name="password"></th>
 		</tr>
 		<tr><td colspan="2"><a href="reg.php">注册</a></td></tr>
 		<tr>
 			<th>
 				<input type="submit" value="登录">
</form>
 			</th>
 		</tr>
	</table>
