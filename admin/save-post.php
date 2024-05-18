<?php

include "config.php";
if(isset($_FILES['fileToUpload']))
{
    $errors = "";

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_name = $_FILES['fileToUpload']['name'];
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

session_start();
$title = $_POST['post_title'];
$description = $_POST['postdesc'];
$category = $_POST['category'];
$date = date("d M, Y");
$author = $_SESSION["user_id"];

$qry1 = "insert into post(title, description, category, post_date, author, post_img) values('$title', '$description', '$category', '$date', '$author', '$file_name');";
$qry1 .= "update category set post = post + 1 where category_id = $category";

if(mysqli_multi_query($cn, $qry1))
{
    header("Location: http://localhost/news-template/admin/post.php");
}
else
{
    echo "<div class='alert alert-danger'>query failed</div>";
}



?>