<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $email = $_POST['signupEmail'];
    $password = $_POST['Password'];
    $cpassword = $_POST['confirmPassword'];
    $sql1 = "SELECT * FROM `signup_data` WHERE `email` = '$email'";
    // echo $sql1;
    $result = mysqli_query($conn , $sql1);
    // echo $result;
    $num = mysqli_num_rows($result);
    if($num == 0){
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql2 = "INSERT INTO `signup_data` (`email` , `password`) VALUES ('$email' , '$hash')";
            $result = mysqli_query($conn , $sql2);
            // echo var_dump($result);
            header ("location:/forums/index.php?successSignup=true");
            
        }
        else{
            echo "passwords do not match";
            header ("location:/forums/index.php?pass_error=true");
        }
    }
    else{
        echo "user alredy exists";
        header ("location:/forums/index.php?invalid=true");
    }
}
?>
