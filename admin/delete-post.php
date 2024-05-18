<?php

include "config.php";
$glob_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql = "select * from post where post_id = $glob_id";
$result = mysqli_query($cn, $sql) or die("query failed in select");
$row = mysqli_fetch_assoc($result);
unlink("upload/".$row['post_img']);

$sql = "delete from post where post_id = {$glob_id};";
$sql .= "update category set post = post - 1 where category_id = {$cat_id}";

if(mysqli_multi_query($cn, $sql))   
{
    header("Location: http://localhost/news-template/admin/post.php");
}

?>