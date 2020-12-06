<!DOCTYPE html>
<html>

<head>
  <title>Login & Registration</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/stylelogin.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">

</head>

<body>
  <?php
  include_once('server.php');
  session_start();
  if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $conn->real_escape_string($_POST['password']);


    $sql = "SELECT * FROM member WHERE username = '$username' AND password = '$password' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['MID'] = $row['MID'];
      $_SESSION['username'] = $row['username'];
      header('location: index.php');
    } else {
      $_SESSION['error'] = "ชื่อผู้ใช้กับรหัสผ่านไม่ถูกต้อง";
    }
  }

  if (isset($_POST['reg_user'])) {
            
    if ($_POST['password_1'] === $_POST['password_2']) {
        $sqlcheck = "SELECT * FROM `member` where `username` = '".$_POST['username']."' or `email` = '".$_POST['email']."' ";
        $resultchk = $conn->query($sqlcheck);
        if(!$resultchk->num_rows){
            $password = $_POST['password_1'];
            $sql = "INSERT INTO member (`username`, `password`, `firstname`, `lastname`, `email`) 
            VALUES ('". $_POST['username']."', '".$password."', '".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['email']."')";

            $result = $conn->query($sql);

            if ($result) {  
                $_SESSION['username'] = $_POST['username'];
                
                header('location:index.php');
            } else {
                echo 'no';
            }
        }else{
            $_SESSION['error'] = "มีชื่อผู้ใช้หรืออีเมลนี้แล้ว";
        }
    
} else {
    $_SESSION['error'] = "รหัสผ่านกับยืนยันรหัสผ่านไม่ตรงกัน";
}  
}

  ?>
  <div class="cont <?=$_GET['page']?>">
    <div class="form sign-in">
      <form action="" method="post">
        <h2>LOGIN</h2>
        <label>
          <span>Username</span>
          <input type="text" name="username">
        </label>
        <label>
          <span>Password</span>
          <input type="password" name="password">
        </label>
        <button class="submit" type="submit" name="login_user">Sign In</button>
      </form>
    </div>

    <div class="sub-cont">
      <div class="img">
        <div class="img-text m-up">
          <h2>New here?</h2>
          <p>Sign up and discover great amount of new opportunities!</p>
        </div>
        <div class="img-text m-in">
          <h2>One of us?</h2>
          <p>If you already has an account, just sign in. We've missed you!</p>
        </div>
        <div class="img-btn">
          <span class="m-up">REGISTER</span>
          <span class="m-in">LOGIN</span>
        </div>
      </div>
      <div class="form sign-up">
      <form action="" method="post">
        <h2>REGISTER</h2>
        <label style="display:flex; justify-content:center;">
          <span>Firstname</span>
          <input style="width:170px;" type="text"  name="firstname">
          <span>Lastname</span>
          <input style="width:170px;" type="text" name="lastname">
        </label>
        <label>
          <span>Username</span>
          <input type="text" name="username">
        </label>
        <label>
          <span>Password</span>
          <input type="password" name="password_1">
        </label>
        <label>
          <span>Confirm Password</span>
          <input type="password" name="password_2">
        </label>
        <label>
          <span>Email</span>
          <input type="email" name="email">
        </label>
        <button type="submit" class="submit" name="reg_user">Sign Up Now</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    <?php
    if (isset($_SESSION['error'])) {
    ?>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?php echo $_SESSION['error'] ?>',
      })
    <?php
      unset($_SESSION['error']);
    }
    ?>
  </script>

  <script type="text/javascript" src="loginscript.js"></script>
</body>

</html>