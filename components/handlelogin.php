<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $email= $_POST['loginEmail'];
    $pass = $_POST['Pass'];
    $sql= "SELECT * FROM `signup_data` where `email` = '$email'";
    $result = mysqli_query($conn , $sql);
    $num = mysqli_num_rows($result);
    if($num ==1){

        $row = mysqli_fetch_assoc($result);
        $sno = $row['sno'];
        if(password_verify($pass , $row['password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['sno']= $sno;
            header ("location:/forums/index.php?login= true");
        }
    }
    else{
        // echo "Invalid credentils";
        header ("location:/forums/index.php?login = false");
    }
}

?>