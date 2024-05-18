<?php include "header.php"; 

    include "config.php";

    $limit = 4;
    

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    $offset = ($page - 1) * $limit;

    $qry1 = "select * from user order by user_id desc limit $offset, $limit";
    $result = mysqli_query($cn, $qry1) or die("query failed");


?>
<?php

if($_SESSION["user_role"] == '0')
{
    header("Location: http://localhost/news-template/admin/post.php");

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php

                            while($row = mysqli_fetch_assoc($result))
                            {

                        ?>
                          <tr>
                              <td class='id'><?php echo $row['user_id'] ?></td>
                              <td style="text-transform: capitalize;"><?php echo $row['first_name']. "  ".$row['last_name'] ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td>
                                <?php 
                                    if($row['role'] == 0) 
                                        echo "normal";
                                    else
                                        echo "admin"; 
                                ?>
                                </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $row['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                            }
                          ?>
                      </tbody>
                  </table>

                
                    <?php

                            $qry2 = "select * from user";
                            $result2 = mysqli_query($cn, $qry2);
                            if(mysqli_num_rows($result2) > 0)
                            {
                                $total_rec = mysqli_num_rows($result2);
                                
                                $total_page = ceil($total_rec / $limit);

                                echo "<ul class='pagination admin-pagination'>";
                                for($i=1; $i <= $total_page; $i++)
                                {
                                    echo "<li><a href='users.php?page=$i'>$i</a></li>";
                                }
                                echo "</ul>";
                            }
                    ?>



              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
