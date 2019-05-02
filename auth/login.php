<?php
    include('config.php');
    if(!empty($_SESSION['logged_in']) && $_SESSION['logged_in']==TRUE){

        //header('Location:../login.html');
        if($_SESSION['user_type']=='Booker'){

            $result=[
                message=>'already logged in',
                url=>'./booker.html'
            ];
            $result=json_encode($result);
        
            echo $result;
        

        }else{

            $result=[
                message=>'already logged in',
                url=>'./owner.html'
            ];
            $result=json_encode($result);
        
            echo $result;
        

        }
        
    }else{
        

        if (isset($_POST['submit'])) {

            //include('./config.php');
            
            if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['email']) && !empty($_POST['email'])){
                
                    $name=test_input($_POST['name']);
                    $password=test_input($_POST['password']);
                    $email=test_input($_POST['email']);
        
                    $query=mysqli_query($conn,"SELECT * FROM `users` WHERE name='$name' AND email='$email'");
                    
                    if (mysqli_num_rows($query)) {
                        
                        $query=mysqli_fetch_assoc($query);
                        //print_r($query);
                        $hash=$query["password"];
                        $password=md5($password);
                        if ($hash==$password) {
                            
                
                            if ($query['user_type']=='booker') {
                                $result=[
                                    'message'=>'welcome booker',
                                    'url'=>'./booker.html'
                                ];
                                $result=json_encode($result);
                                echo $result;
                            
                            $_SESSION['email']=$email;
                            $_SESSION['password']=$password;
                            $_SESSION['name']=$name;
                            $_SESSION['type']=$query['user_type'];



                            }else{
                                $result=[
                                    'message'=>'welcome owner',
                                    'url'=>'./owner.html'
                                ];
                                $result=json_encode($result);
                                echo $result;
                            }
                        }else{
                            $result=[
                                'message'=>'you seem to have entered the wrong password',
                                'url'=>'./login.html'
                            ];
                            $result=json_encode($result);
                            echo $result;
                        }
        
                    }else{
        
                        $result=[
                            'message'=>'invalid email/username',
                            'url'=>'./login.html'
                        ];
                        $result=json_encode($result);
                        echo $result;
                    }
        
        
                    }else{
        
                        $result=[
                            'message'=>'the fields are required',
                            'url'=>'./login.html'
                        ];
                        $result=json_encode($result);
                        echo $result;
                    }
        
    }
        
        



    }
    
    
 ?>
    


