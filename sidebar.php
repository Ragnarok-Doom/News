<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
                    include 'admin/config.php';
                    $limit = 3;     
                    $sql1 = "select * from post 
                             left join category on post.category = category.category_id 
                             order by post_id desc limit {$limit}";
                    $result1 = mysqli_query($cn, $sql1) or die("query on recent post failed");
                    while($row2 = mysqli_fetch_assoc($result1))
                    {
        ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $row2['post_id'] ?>">
                <img src="admin/upload/<?php echo $row2['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href='single.php?id=<?php echo $row2['post_id'] ?>'><?php echo $row2['title']; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $row2['category']; ?>'><?php echo $row2['category_name']; ?>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row2['post_date'] ?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $row2['post_id'] ?>">read more</a>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- /recent posts box -->
</div>
