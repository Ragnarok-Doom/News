<?php include "header.php"; 
include "config.php";
    $s_id = $_GET['id'];

    


$qry1 = "select * from user where user_id = $s_id";
$result1 = mysqli_query($cn, $qry1);

if(isset($_POST['submit']))
{
    $id = $_POST['user_id'];
    $fname = $_POST['f_name'];
    $lname = $_POST['l_ name'];
    $user = $_POST['username'];
    $pass = sha1($_POST['password']);
    $role = $_POST['role'];
$qry2 = "update user set first_name = '$fname', last_name = '$lname', username = '$user', role = '$role' where user_id = '$id'";
if(mysqli_query($cn, $qry2))
{
    header("Location: http://localhost/news-template/admin/users.php");
}
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                    <?php
                        while($row = mysqli_fetch_assoc($result1))
                        {
                    ?>
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role">
                            <?php

                            if($row['role'] == 0 ){
                                echo '<option value="0" selected>normal</option>
                                      <option value="1">Admin</option>';
                            }
                            else
                            {
                                echo '<option value="0">normal User</option>
                                      <option value="1" selected>Admin</option>';
                            }

                            ?>
                              
                          </select>
                      </div>
                      <?php
                        }
                      ?>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
