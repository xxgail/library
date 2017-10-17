<?php

session_start();
include('head.php');
require('dbconnect.php');

if (!isset($_SESSION['Adm'])) {
	echo "管理员没有登录，请";
	echo "<a href=Adminlogin.php>登录</a>";
	exit();
}

?>

<?php
$title = $_POST['title'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$publish_year = $_POST['publish_year'];
$total = $_POST['total'];
$other = $_POST['other'];

//检查该书是否已存在
$checksql = "select * from book where title = '$title' and publisher = '$publisher' and author = '$author' and publish_year = '$publish_year'";
$checkresult = mysql_query($checksql,$conn);
$checkrow = mysql_fetch_array($checkresult);

if (!empty($checkrow)) {
	echo "该书已入库，无需再入。操作失败！<a href='addbook.php'>请重试</a>";
	exit();
}

//可以顺利入库
$sql = "insert into book(title,author,publisher,publish_year,total,leave_number,other) values('$title','$author','$publisher',$publish_year,$total,$total,'other')";
mysql_query($sql,$conn) or die("操作失败".mysql_error());

$result = mysql_query("select last_insert_id()",$conn);
$re_arr = mysql_fetch_array($result);
$id = $re_arr[0];

echo "新书入库成功！";
echo "该书的ID是：".$id;
echo "<a href='addbook.php'>继续添加新书</a>";

?>