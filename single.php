<?php 
    include 'header.php'; 
    $glob_id = $_GET['id'];

    include 'admin/config.php';



$sql2 = "select * from post 
         left join category on post.category = category.category_id 
         left join user on post.author = user.user_id  where post_id = $glob_id";
$result2 = mysqli_query($cn, $sql2) or die("query failed");
     


?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php
                        while($row2 = mysqli_fetch_assoc($result2))
                        {
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $row2['title']; ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $row2['category']; ?>'><?php echo $row2['category_name']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row2['author']; ?>'><?php echo $row2['username']; ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row2['post_date']; ?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row2['post_img']; ?>" alt=""/>
                            <p class="description">
                            <?php echo $row2['description']; ?>
                            </p>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /post-container -->
                    
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
