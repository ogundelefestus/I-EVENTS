<?php
$conn=mysqli_connect('localhost','root','','i-events');
if($result){
    echo"connected";
    session_start();
}else{
    
    //echo"not connected";
    die("could not connect").mysqli_error;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


?>