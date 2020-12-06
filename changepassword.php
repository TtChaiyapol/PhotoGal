<!DOCTYPE html>
<html>

<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="css/stypech.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top " >
		<a class="navbar-brand" style="font-weight:bolder;" href="index.php">NAVBAR</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
  
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav ml-auto">
			<!-- <li class="nav-item m-1">
			  <a class="nav-link " href="index.php">Home</a>
			</li> -->
			<?php
			session_start();
			include('server.php');
			$sql = "SELECT * FROM member where `username`= '" . $_SESSION['username'] . "' ";
			$result = $conn->query($sql);
			$data = $result->fetch_assoc();
			if (!isset($_SESSION['username'])) :
			?>
			  <li class="nav-item">
				<a class="nav-link m-1 " href="loginnew.php">Login</a>
			  </li>
			  <hr>
			  <li class="nav-item">
				<a class="nav-link m-1" href="loginnew.php?page=s-signup">Register</a>
			  </li>
			<?php endif ?>
			<?php
			if (isset($_SESSION['username'])) :
			?>
			  <li class="nav-item d-flex align-items-center">
  
			  </li>
			  <li class="nav-item d-flex align-items-center ">
				<div class="dropdown d-flex align-items-center ">
				  <a style="height:40px;color:white;" class="nav-link m-1 btn btn-secondary d-flex align-items-center" href="" id="profiledropdown" data-toggle="dropdown">
					<img src="profile/profile0.png" style="width:35px; height:35px;" class="rounded-circle ">
					<?= $_SESSION['username'] ?>
				  </a>
				  <div class="dropdown-menu" aria-labelledby="profiledropdown">
				  <a class="dropdown-item" href="showprofile.php">Edit Profile</a>
                  <a class="dropdown-item" href="changepassword.php">Change Password</a>
					<a class="dropdown-item" href="index.php?logout='1'">Logout</a>
				  </div>
				</div>
			  </li>
			  <li class="nav-item d-flex align-items-center">
				<a style="height: 40px; padding-top:5px;color:white;" class="nav-link m-1 btn btn-success" href="" data-toggle="modal" data-target="#exampleModalCenter">Upload</a>
			  </li>
			<?php endif ?>
		</div>
	  </nav>

	<?php
	if (isset($_POST['changepass'])) {
		$sqlpass = "SELECT * FROM member where `username`= '" . $_SESSION['username'] . "' ";
		$resultpass = $conn->query($sqlpass);
		$rowpass = $resultpass->fetch_assoc();
		if ($_POST['curpass'] === $rowpass['password']) {
			if ($POST['newpass'] === $POST['newpasscon']) {
				$sql = "UPDATE member set `password` = '" . $_POST['newpass'] . "' where `username`= '" . $_SESSION['username'] . "' ";
				$result = $conn->query($sql);
				if($result){
					$_SESSION['success'] = "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว";
					header('location:index.php');
				}
			} else {
				$_SESSION['error'] = "รหัสผ่านและยืนยันรหัสผ่านไม่ตรงกัน";
			}
		} else {
			$_SESSION['error'] = "รหัสผ่านเดิมไม่ถูกต้อง";
		}
	}
	?>
	<div class="container">
		<div class="contact-box">
			<div class="left">

			</div>
			<div class="right">
				<h2>Change Password </h2>
				<div class="form-group row ml-1">
					<label for="staticEmail" class="col-form-label">Username: <?= $_SESSION['username'] ?></label>
				</div>
				<form action="" method="POST">
					<input type="password" class="field" placeholder="Current Password" name="curpass">
					<input type="password" class="field" placeholder="New Password" name="newpass">
					<input type="password" class="field" placeholder="Confirm  Password" name="newpasscon">
					<a href="edit-user.php"><button type="submit" name="changepass" class="btn btn-outline-success">Success</button></a>
				</form>
			</div>
		</div>
	</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script>
		<?php
		if (isset($_SESSION['upload_error'])) {
		?>
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: '<?php echo $_SESSION['upload_error'] ?>',
			})
		<?php
			unset($_SESSION['upload_error']);
		}
		?>
	</script>
</body>

</html>