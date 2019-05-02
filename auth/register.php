<?php

//session_start();
require('config.php');
if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in']==TRUE){

    //header('Location:../login.html');
    $result=[
        message=>'already logged in',
        url=>'./index.html'
    ];
    $result=json_encode($result);

    echo $result;

}else{
    if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['type']) && !empty($_POST['type']) && isset($_POST['name']) && !empty($_POST['name'])){
   
        $email=test_input($_POST['email']);
        $password=test_input($_POST['password']);
        $name=test_input($_POST['name']);
        $type=test_input($_POST['type']);
        $phone_no=test_input($_POST['phone']);

        $query=mysqli_query($conn,"SELECT * FROM `users` WHERE name='$name' AND email='$email' AND user_type='$type'");

        $result=mysqli_fetch_assoc($query);


        if($result["id"]>0){
            //echo(js_alert("user already exists in the database"));
            $result=[
                'message'=>'user already exists in the database',
                'url'=>'./index.html'
            ];
            $result=json_encode($result);
            echo $result;


        }else{

        $query=mysqli_query($conn,"INSERT INTO `users` (`name`,`password`,`email`,`user_type`,`phone_number`) VALUES('$name','$password','$email','$type','$phone_no')");
        if($query){


            $result=[
                'message'=>'registration successful',
                'url'=>'./login.html'
            ];
        
            $result=json_encode($result);
            echo $result;

        
        }else{
            $result=[
                'message'=>'not registered successfully',
                'url'=>'./signup.html'
            ];
        
            $result=json_encode($result);
            echo $result;
        
        }
    } 
   
        
}else{

    $result=[
        'message'=>'you have to fill all the fields',
        'url'=>'./login.html'
    ];
    $result=json_encode($result);
    echo $result;
}
}







?>