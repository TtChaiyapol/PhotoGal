<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>


<body>

    <?php
    include_once('server.php');
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 img">
                <div class="card p-4 bgcolorblock w-50 mx-auto mt-5">
                    <span style="color:#FFFFFF;font-size:40px;">REGISTER INFO</span>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="text-white" for="Username">Username</label>
                            <input type="text" class="form-control" name="username" id="Username" required>
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="InputPassword1">Password</label>
                            <input type="password" class="form-control" name="password_1" id="InputPassword" required>
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="ConfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" name="password_2" id="ConfirmPassword" required>
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="InputFirstname">Firstname</label>
                            <input type="text" class="form-control" name="firstname" id="InputFirstname" required>
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="InputLastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" id="InputLastname" required>
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="InputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email" id="InputEmail" required>
                        </div>
                        <?php 
                            if(isset($_SESSION['error'])):
                                echo '<div class="alert alert-danger mt-2">'; 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                echo '</div>';
                         endif ?>
                        <button type="submit" name="reg_user" class="btn btn-success">Register</button>
                        <a href="index.php" class="btn btn-outline-light ">Back to Homepage</a>
                    </form>
                    <br>
                    <p style="color:white;">Already a member ? <a href="login.php">Sign in</a></p>
                </div>
            </div>
        </div>

    </div>





</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</html>