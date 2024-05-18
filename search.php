<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <?php
                    $search_term = $_GET['search'];
                    include "admin/config.php";
                    if(isset($_GET['search']))
                    {
                  ?>

                  <h2 class="page-heading">Search : <?php echo $search_term ?></h2>

                  <?php
                      
                    $limit = 3;
                    if(isset($_GET['page']))
                    {
                        $page = $_GET['page'];
                    }
                    else
                    {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    $sql2 = "select * from post order_by post_id desc limit $offset, $limit";
                    $result2 = mysqli_query($cn, $sql2);
                    
                    if(isset($_GET['search']))
                    {
                        $search_term = $_GET['search'];
                    }
                    $sql2 = "select * from post 
                             left join category on post.category = category.category_id 
                             left join user on post.author = user.user_id where post.title like '%{$search_term}%' or post.description like '%{$search_term}%'
                             order by post_id desc limit {$offset}, {$limit}";
                    $result2 = mysqli_query($cn, $sql2) or die("query failed");
                    while($row2 = mysqli_fetch_assoc($result2))
                    {
                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row2['post_id'] ?>"><img src="admin/upload/<?php echo $row2['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row2['post_id'] ?>'><?php echo $row2['title']; ?></a></h3>
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
                                        <p class="description">
                                        <?php echo $row2['description']; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row2['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <?php 
                        }
                    }
                    else
                    {
                        echo "<h2>no record found</h2>";
                    }
                    
                    
                    $sql1 = "select * from post where post.title like '%{$search_term}%'";
                    $result1 = mysqli_query($cn, $sql1) or die("queryyyyy failed");
                    $row1 = mysqli_fetch_assoc($result1);
                        
                        $active = "";
                        $tot_rec = mysqli_num_rows($result2);
                        $tot_page = ceil($tot_rec / $limit);

                        echo "<ul class='pagination'>";
                        for($i=1; $i<=$tot_page; $i++)
                        {
                            if($i == $page)
                            {
                                $active = "active";
                            }
                            else
                            {
                                $active = "";
                            }
                            echo '<li class="$active"><a href="index.php?search='.$search_term .'&page='.$i.'">'.$i.'</a></li>';
                        }
                        echo "</ul>";
                    

                        ?>

                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
