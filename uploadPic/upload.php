<?php
include('../server.php');   
session_start();
if(isset($_POST['upload_pic'])){
    $check = getimagesize($_FILES['file']['tmp_name']);
    if($check){

    $dir = "../uploads/";
    $temp = explode('.',$_FILES['file']['name']);
    $newName = round(microtime(true)).'.'. end($temp);
    $fileImage = $dir . $newName; 

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $fileImage)){
        $sqluploadpic = "INSERT INTO picture(`MID`,`picname`,`tmp_name`) VALUES ('".$_SESSION['MID']."','". $newName."','". $fileImage."')";
        echo $sqluploadpic;
        $result = $conn->query($sqluploadpic);
        $sqlselectpic = "SELECT picID FROM picture where `picname` = '".$newName."' ";
        $resultpic = $conn->query($sqlselectpic);
        if ($resultpic->num_rows > 0) :
            while($row = $resultpic->fetch_assoc()) {
                $sqluploadtag = "INSERT INTO tag (`tagname`, `picID`) VALUES ('". $_POST['tagname']."', '".$row["picID"]."')" ;
                $conn->query($sqluploadtag);
            }
        endif;
        header('location:../index.php');
    }else{
    }
}else{
    $_SESSION['upload_error'] = "ไฟล์ที่อัพโหลดมาไม่ใช่รูปภาพ";
    header('location:../index.php');
}
}else{
    
}

?>