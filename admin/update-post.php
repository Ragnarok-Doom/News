<?php 
include "header.php"; 
include "config.php";

$glob_id = $_GET['id'];

$sql2 = "select * from post 
        left join category on post.category = category.category_id 
        left join user on post.author = user.user_id
        where post.post_id = {$glob_id}";
$result2 = mysqli_query($cn, $sql2) or die("query update failed");
while($row2 = mysqli_fetch_assoc($result2))
{





?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row2['post_id']; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row2['title']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $row2['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php

                    
                    $sql1 = "select * from category";
                    $result1 = mysqli_query($cn, $sql1) or die("query 1 failed");
                    while($row1 = mysqli_fetch_assoc($result1))
                    {
                        if($row2['category'] == $row1['category_id'])
                        {
                            $select = "selected";
                        }
                        else
                        {
                            $select = "";
                        }
                        echo "<option {$select} value='{$row1['category_id']}'>{$row1['category_name']}</option>";   
                    }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="upload/<?php echo $row2['post_img']; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row2['post_img']; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php
    }
?>
<?php include "footer.php"; ?>
