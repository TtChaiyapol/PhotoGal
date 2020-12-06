<?php 

    $username = 'root';
    $pass = '';
    $dbname = 'photogal';

    $conn = mysqli_connect('localhost', $username, $pass, $dbname);

    if(!$conn){
        die("Connection failed". mysqli_connect_error());
    }
    

?>