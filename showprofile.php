<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile</title>
  <link rel="stylesheet" href="./css/showprofile.css">
  <link rel="stylesheet" href="./css/stylenvg.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <style>
    .nav .nav-item .nav-link {
      color: #aaa !important;
    }

    .nav .nav-item .nav-link:hover {
      color: black !important;
      border: 0;
    }

    .nav-tabs {
      border-bottom: #aaa 1px solid;
    }

    .nav .nav-item .nav-link.active {
      border: 0;
      color: black !important;
      border-bottom: 2px black solid;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  include('server.php');
  if (isset($_GET['MID'])) {
    $sql = "SELECT * FROM picture where MID = '" . $_GET['MID'] . "'";
    $sqlprofile = "SELECT * FROM member where `MID`= '" . $_GET['MID'] . "' ";
    $sqllikepicinprofile = "SELECT p.picID, p.picname, p.tmp_name, p.upload_at FROM picture p join like_pic lp on (p.picID = lp.picID)
    join member m on (m.MID = lp.MID)
    where p.picID = lp.picID  and lp.MID = '" . $_GET['MID'] . "'  and lp.MID != p.MID ";
  } else {
    $sql = "SELECT * FROM picture where MID = '" . $_SESSION['MID'] . "'";
    $sqlprofile = "SELECT * FROM member where `username`= '" . $_SESSION['username'] . "' ";
    $sqllikepicinprofile = "SELECT p.picID, p.picname, p.tmp_name, p.upload_at FROM picture p join like_pic lp on (p.picID = lp.picID)
    join member m on (m.MID = lp.MID)
    where p.picID = lp.picID  and lp.MID = '" . $_SESSION['MID'] . "'  and lp.MID != p.MID ";
  }

  $resultprofile = $conn->query($sqlprofile);
  $rowprofile = $resultprofile->fetch_assoc();
  ?>

  <nav class="navbar navbar-expand-lg navbar-light fixed-top ">
    <a class="navbar-brand" href="index.php">NAVBAR</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <!-- <li class="nav-item m-1">
            <a class="nav-link " href="index.php">Home</a>
          </li> -->
        <?php
        if (isset($_SESSION['username'])) :
        ?>
          <li class="nav-item d-flex align-items-center ">
            <div class="dropdown d-flex align-items-center ">
              <a style="height:40px;color:white;width:120px;" class="nav-link m-1 btn btn-secondary d-flex align-items-center" href="" id="profiledropdown" data-toggle="dropdown">
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


  $resultpicture = $conn->query($sql);

  $resultlikepicinprofile = $conn->query($sqllikepicinprofile);
  ?>
  <!--  profile -->
  <div class="container">
    <div class="row w-100 d-flex">
      <div class="col-12 py-5">
        <div class="row d-flex justify-content-center">
          <div class="d-flex align-items-center justify-content-center">
            <img class="mr-5" style="
                  border-radius: 50%;
                  width: 150px;
                  height: 150px;
                  object-fit: cover;
                " src="profile.jpg" alt="" />

            <div class="d-flex flex-column">
              <div class="d-flex align-items-center">
                <span style="font-size: 40px; font-weight: 20px; text-transform: uppercase;">
                  <?= $rowprofile['firstname'] ?>
                </span>
                <a href="edit-user.php"><button style="
                      height: 40px;
                      width: 120px;
                      font-size: 13px;
                      height: 35px;
                      text-transform: uppercase;" type="button" class="btn btn-outline-secondary ml-4">
                    Edit Profile </button></a>
              </div>
              <div>
                <p>
                  <?= $rowprofile['email'] ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <ul class="nav nav-tabs px-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" style="width: auto" id="home-tab" data-toggle="tab" href="#Photos" role="tab" aria-controls="Photos" aria-selected="true"><i class="fa fa-picture-o mr-1" aria-hidden="true"></i><span>Photos&nbsp;</span><span><?= $resultpicture->num_rows ?></span></a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="profile-tab" style="width: auto" data-toggle="tab" href="#Likes" role="tab" aria-controls="Likes" aria-selected="false"><i class="fa fa-thumbs-o-up mr-1" aria-hidden="true"></i><span>Likes&nbsp;</span><span><?= $resultlikepicinprofile->num_rows ?></span></a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="Photos" role="tabpanel" aria-labelledby="Photos-tab">
      <!-- แสดงรูปภาพ -->
      <div class="container-fluid">
        <div class="row">
          <?php
          $i = 1;
          $col1 = '';
          $col2 = '';
          $col3 = '';
          if ($resultpicture->num_rows > 0) {
            while ($row = $resultpicture->fetch_assoc()) {
              switch ($i % 3) {
                case 1:
                  $col1 = $col1 . "<a><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
                  break;
                case 2:
                  $col2 = $col2 . "<a><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
                  break;
                case 0:
                  $col3 = $col3 . "<a><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
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
    </div>
    <div class="tab-pane fade" id="Likes" role="tabpanel" aria-labelledby="Links-tab">
      <!-- แสดงรูปภาพ -->
      <div class="container-fluid">
        <div class="row">
          <?php

          $i = 1;
          $col1 = '';
          $col2 = '';
          $col3 = '';
          if ($resultlikepicinprofile->num_rows > 0) {
            while ($row = $resultlikepicinprofile->fetch_assoc()) {
              switch ($i % 3) {
                case 1:
                  $col1 = $col1 . "<a><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
                  break;
                case 2:
                  $col2 = $col2 . "<a><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
                  break;
                case 0:
                  $col3 = $col3 . "<a><img src='/WEB_Photo%20Gallery/" . substr($row['tmp_name'], 3) . "' alt='" . $i . "' ></a>";
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
      
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="app.js"></script>
</body>

</html>