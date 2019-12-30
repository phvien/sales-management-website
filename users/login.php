<?php
  session_start();
  include_once("users.php");
  if (isset($_SESSION['username']))
  {
    echo "<script>window.location='../home/homepage.php';</script>";
  }
  if(isset($_POST['login']))
  {   
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $user=logininfor_true($username, $password);
    if ($user)
    {    
        $_SESSION['u_loginname']=$user['u_loginname'];
        $_SESSION['u_id']=$user['u_id'];
        $_SESSION['r_id']=$user['r_id'];
        $_SESSION["r_name"]=$user['r_name'];
        echo "<script>window.location='../home/homepage.php';</script>";
    }
    else
    {
      echo "<script>alert('Username or password is incorrect!')</script>";
      echo "<script>window.history.back();</script>";
    }
    disconnect_db();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <?php
    include_once("../layout/meta_link.php");
  ?>

  <title>PC House - Login</title>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" placeholder="Enter Username" required >
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="login" value="Log in">
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>

  </div>

  <?php
    include_once("../layout/script.php");
  ?>

</body>

</html>
