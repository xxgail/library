<?php

$conn = mysql_connect("localhost","root","123") or die("不能连接数据库".mysql_error());
mysql_select_db("book",$conn) or die("不能选择数据库".mysql_error());