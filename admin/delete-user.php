<?php
include "config.php";
$s_id = $_GET['id'];
$qry = "delete from user where user_id = '$s_id'";
mysqli_query($cn, $qry) or die("query failed");
header("Location: http://localhost/news-template/admin/users.php");
?>