<?php
include "config.php";

if(empty($_FILES['new-image']['name']))
{
    $file_name = $_POST['old-image'];
}
else
{
    $errors = "";

    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extentions = array("jpeg", "jpg", "png");

    if(in_array($file_ext, $extentions) === false)
    {
        $errors[] = "This extention file not allowed";
    }

    if($file_size > 2097152)
    {
        $errors[] = "File must be in 2 MB.";
    }

    if(empty($errors) === TRUE)
    {
        move_uploaded_file($file_tmp, "upload/".$file_name);
    }
    else
    {
        echo "error in uploading";
        die();
    }



}
$sql = "update post set title = '{$_POST['post_title']}', description = '{$_POST['postdesc']}', category = {$_POST['category']}, post_img='$file_name' where post_id = {$_POST['post_id']}";
$result = mysqli_query($cn, $sql) or die("query failed");
if($result)
{
    header("Location: http://localhost/news-template/admin/post.php");
}
?>