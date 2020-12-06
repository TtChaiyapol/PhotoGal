<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <?php
    include_once('server.php');

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
            }else{
                $_SESSION['error'] = "ชื่อผู้ใช้กับรหัสผ่านไม่ถูกต้อง";
            }
        }
    
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 img">
                <div class="card p-4 bgcolorblock w-25 mx-auto mt-5">
                    <span style="color:#FFFFFF;font-size:60px;">Sign in</span>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="text-white" for="Username">Username</label>
                            <input type="text" class="form-control w-100" name="username" id="Username">
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="InputPassword1">Password</label>
                            <input type="password" class="form-control w-100" name="password" id="InputPassword">
                        </div>
                        <button type="submit" name="login_user" class="btn btn-success">Sign in</button>
                        <?php 
                            if(isset($_SESSION['error'])):
                                echo '<div class="alert alert-danger mt-2">'; 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                echo '</div>';
                         endif ?>
                        <p style="color:white;"><br>ยังไม่ได้เป็นสมาชิกหรอ ? <a href="register.php">Register</a></p>
                    </form>
                </div>
            </div>
        </div>

    </div>





</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</html>