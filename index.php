<?php session_start();
include('server.php');


if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomePage</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/58af0c5fea.js" crossorigin="anonymous"></script>

</head>

<body>

  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top ">
      <a class="navbar-brand" href="index.php">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <!-- <li class="nav-item m-1">
            <a class="nav-link " href="index.php">Home</a>
          </li> -->
          <?php
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
            <li class="nav-item d-flex align-items-center ">
              <div class="dropdown d-flex align-items-center ">
                <a style="height:40px;" class="nav-link m-1 btn btn-secondary" href="" id="profiledropdown" data-toggle="dropdown">
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
              <a style="height: 40px; padding-top:5px;" class="nav-link m-1 btn btn-success" href="" data-toggle="modal" data-target="#exampleModalCenter">Upload</a>
            </li>
          <?php endif ?>
      </div>
    </nav>

    <!-- upload image -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">อัพโหลดรูปภาพ</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="uploadPic/upload.php" method="post" enctype="multipart/form-data">
              <input type="file" name="file">
              <div class="form-group">
                <br><label class="text-black" for="tagname">Tag</label>
                <input type="text" class="form-control" name="tagname" id="tagname" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="upload_pic">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- upload image -->
    <!-- ช่องค้นหา -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item">
          <img style="object-fit:cover;" src="images/newphoto2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Search</h5>
            <p>ค้นหารูปภาพที่คุณชอบ ผ่านช่องค้นหาที่ใช่</p>
            <form action="" method="get" class="input-group mb-3 w-50 mx-auto mt-3">
              <input type="text" name="search_tag" class="form-control" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;" placeholder="Keyword to find image" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" name="searchpic" type="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="carousel-item">
          <img style="object-fit:cover;" src="images/newphoto3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Search</h5>
            <p>ค้นหารูปภาพที่คุณชอบ ผ่านช่องค้นหาที่ใช่</p>
            <form class="input-group mb-3 w-50 mx-auto mt-3">
              <input type="text" name="search_tag" class="form-control" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;" placeholder="Keyword to find image" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" name="searchpic" type="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="carousel-item active">
          <img style="object-fit:cover;" src="bglogin.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Search</h5>
            <p>ค้นหารูปภาพที่คุณชอบ ผ่านช่องค้นหาที่ใช่</p>
            <form action="" method="get" class="input-group mb-3 w-50 mx-auto mt-3">
              <input type="text" name="search_tag" class="form-control" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;" placeholder="Keyword to find image" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" name="searchpic" type="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" draggable="false">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" draggable="false">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div>
    <!-- ช่องค้นหา -->
    </nav>
    <!-- แสดงรูปภาพ -->
    <div class="container-fluid">
      <div class="row">
        <?php
        if (isset($_GET['searchpic'])) {
          $sql = "SELECT * FROM picture natural join tag where tagname like '%" . $_GET['search_tag'] . "%'";
        } else {
          $sql = "SELECT * FROM picture";
        }

        $resultpicture = $conn->query($sql);
        $i = 1;
        $col1 = '';
        $col2 = '';
        $col3 = '';
        if ($resultpicture->num_rows > 0) {
          while ($row = $resultpicture->fetch_assoc()) {
            switch ($i % 3) {
              case 1:
                $col1 = $col1 . "<a href='index.php?id=" . $row['picID'] . "&toggle=1'><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
                break;
              case 2:
                $col2 = $col2 . "<a href='index.php?id=" . $row['picID'] . "&toggle=1'><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
                break;
              case 0:
                $col3 = $col3 . "<a href='index.php?id=" . $row['picID'] . "&toggle=1'><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
                break;
            }
            $i++;
          }
        }
        ?>

        <form action="" method="get" class="column">
          <?= $col1 ?>
        </form>

        <form action="" method="get" class="column">

          <?= $col2 ?>

        </form>
        <form action="" method="get" v class="column">
          <?= $col3 ?>
        </form>

      </div>
    </div>
    <!-- แสดงรูปภาพ -->
    <!-- modal picture -->
    <?php
    if (isset($_GET['toggle'])) {
      $sqlmodalpic = "SELECT * FROM picture where picID = " . $_GET['id'] . "";
      $resultpicturemodal = $conn->query($sqlmodalpic);
      $rowpic = $resultpicturemodal->fetch_assoc();
      $sqlmodaluser = "SELECT * FROM member where MID = " . $rowpic['MID'] . "";
      $resultusermodal = $conn->query($sqlmodaluser);
      $rowuser = $resultusermodal->fetch_assoc();
      $dir = "uploads/";
      $image = substr($rowpic['tmp_name'], 3);
      list($width, $height) = getimagesize($image);
      
    ?>
    <div class="modal fade" id="picturemodal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div>
              <a style="height:40px;" class="nav-link m-1 btn btn-outline-secondary" href="showprofile.php?MID=<?php echo $rowuser['MID']; ?>" >
                <img src="profile/profile0.png" style="width:35px; height:35px;" class="rounded-circle ">
                <?= $rowuser['username'] ?>
              </a>
            </div>
            <div class="d-flex justify-content-end">
              <a href="index.php">
                <button type="button" class="close" aria-label="Close">
                  <span class="" aria-hidden="true"> &times;</span>
                </button></a>
            </div>
          </div>
          <div class="modal-body d-flex flex-column justify-content-center">
            <?php
            if ($width > $height) {
              echo "<div class='d-flex justify-content-center'>";
              echo "<img style='height:65%; width:65%;' src='/WEB_Photo%20Gallery/" . substr($rowpic['tmp_name'], 3) . " '>";
              echo "</div>";
            } elseif ($width < $height) {
              echo "<div class='d-flex justify-content-center'>";
              echo "<img style='height:auto; width:320px;' src='/WEB_Photo%20Gallery/" . substr($rowpic['tmp_name'], 3) . " '>";
              echo "</div>";
            }
            ?>
          </div>
          <div class="modal-footer ">
            <?php
            if (isset($_POST['like'])) {
              $sqllike = "INSERT INTO like_pic(`MID`, `picID`) 
                  VALUES ('" . $_SESSION['MID'] . "', '" . $rowpic['picID'] . "')";
              $resultlike = $conn->query($sqllike);
            }
          }      
           
            ?>
            <form action="" method="post" >
            <div class="d-flex justify-content-end">
              <?php 
                
                $admin = 'admin';
                if(isset($_GET['toggle'])){
                  if(isset($_SESSION['username'])){
                  $username = $_SESSION['username'];
                }
                  if(isset($_POST['delete'])){
                    // $sqldeletetag = "DELETE FROM picture p join tag t on (p.picID = t.picID) where t.picID = '" . $_GET['id'] . "' ";
                    $sqldeletepic = "DELETE FROM picture where picID = '" . $_GET['id'] . "' ";
                    // $conn->query($sqldeletetag);
                    $conn->query($sqldeletepic);
                    unset($_GET['toggle']);
                    echo '<script>window.location.href="index.php";</script>';
                  }
                  if($username === $admin){
                    echo"<button type='submit' name='delete' class='btn btn-secondary ml-2'><i id='delete' class='fas fa-trash'></i> Delete</button>";  
                  }
                    if(isset($_SESSION['MID'])){
                $sqllikepic = "SELECT * FROM like_pic where MID = '" . $_SESSION['MID'] . "' and picID = '" . $rowpic['picID'] . "' ";
                $resultlikepic = $conn->query($sqllikepic);
                if($resultlikepic->num_rows > 0){
                  echo"<button type='submit' name='like' class='btn btn-danger ml-2'><i id='like' class='fas fa-heart'></i> Like</button>";  
                }else{
                  echo"<button type='submit' name='like' class='btn btn-danger ml-2'><i id='like' class='far fa-heart'></i> Like</button>";  
                }
              }
              ?> 
              <?php 
                echo "<a href='download.php?pic=" . substr($rowpic['tmp_name'], 3) . "'><button type='button' class='btn btn-success ml-2'>Download</button></a>";
              }
              ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- modal picture -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
      if (isset($_SESSION['success'])) {
      ?>
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '<?php echo $_SESSION['success'] ?>',
        })
      <?php
        unset($_SESSION['success']);
      }
      ?>
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="./indexscript.js"></script>
    <script>
      <?php
      if (isset($_GET['toggle'])) {
        echo "$('#picturemodal').modal('show')";
      }
      ?>
    </script>

</body>

</html>