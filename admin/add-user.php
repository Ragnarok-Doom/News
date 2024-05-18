<?php include "header.php"; 

if(isset($_POST['save'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $user = $_POST['user'];
    $pass = sha1($_POST['password']);
    $role = $_POST['role'];

    // connection
    include "config.php";

    $qry1 = "select username from user where username = '{$user}'";
    $result1 = mysqli_query($cn, $qry1) or die("query 1 faied");

    if(mysqli_num_rows($result1) > 0){
        echo "username already used";
    }
    else{
        $qry2 = "insert into user (first_name,last_name,username,password,role) values('$fname', '$lname', '$user', '$pass', '$role')";
        $result2 = mysqli_query($cn, $qry2) or die("query 2 failed");

        if($result2){
            header("Location: http://localhost/news-template/admin/users.php");
        }

    }
}
?>


  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
