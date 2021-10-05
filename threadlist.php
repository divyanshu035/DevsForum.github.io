<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Discussion point-THREADLIST</title>
    <style>
        .jumbo{
            /* border: 1px solid black; */
            border-radius: 4px;
            background-color: rgba(212, 241, 212, 0.889);
        }
        .jumbo h1{
            font-size: 50px;
        }
    </style>
</head>

<body>

    <?php
    include 'components/dbconnect.php'; ?>
    <?php include 'components/header.php'; ?>
    <?php
    $id= $_GET['Id'];
    // echo $id;
    $sql = "SELECT * FROM `forum_table` WHERE `id`=' $id '";
    $result = mysqli_query($conn , $sql);
    while($row = mysqli_fetch_assoc($result)){
        $name= $row['name'];
        $category= $row['category'];
        // echo $name;
        // echo $category;
        
    }
    
    ?>

<?php 
 if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
    $sno = $_SESSION['sno'];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // echo "post";
        $title= $_POST['problem-title'];
        $desc = $_POST['problem-desc'];
        $sql3= "INSERT INTO `thread_questions` ( `thread_title`, `thread_desc`, `user_id`,  `thread_cat_id`) VALUES ( '$title', '$desc', '$sno',  ' $id ')";
        $result = mysqli_query($conn , $sql3);
        // echo $sno;
        
    }
}
?>

    <div class="container jumbo my-2 pt-5 pb-4">
         <h1> Welcome to  <?php echo $name ?> Forums </h1>
        <p class="lead"><?php echo $category ?></p>
    </div>
    
    <br>

    <div class="container">
        <h2 class="my-2">Ask a Question</h2>
        <?php

            if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
                $sno = $_SESSION['sno'];

                echo '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <div class="mb-3">
                  <label for="problem-title" class="form-label">problem Title </label>
                  <input type="text" class="form-control" id="problem-title" name ="problem-title" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">Keep your problem title as short as possible.</div>
                </div>
                <div class="mb-3">
                  <label for=" problem-desc" class="form-label">problem Description</label>
                  <textarea class="form-control" aria-label="With textarea" id=" problem-desc" name=" problem-desc"></textarea>
                </div>
                
                <button type="submit" class="btn btn-success">Ask Now</button>
              </form>';
            }
            else{
                echo 
                '<p class="lead">Kindly login before Starting a Discussion</p>';
            }
        ?>
    
    </div>

    <br>
    <div class="container my-3 ">
    <h2 my-2>Browse Questions</h2>

    <?php
    $sql2 = "SELECT * FROM `thread_questions` WHERE `thread_cat_id`='$id'";
    $result = mysqli_query($conn , $sql2);
    // echo $sn;
    
    $noRecord = true;
    while($row = mysqli_fetch_assoc($result)){
        $sn = $row["user_id"];

        $sql3= "SELECT * FROM `signup_data` WHERE `sno` ='$sn'";
        $result3 = mysqli_query($conn , $sql3);
        $row3 = mysqli_fetch_assoc($result3);


        $noRecord = false;
        $threadId = $row['thread_id'];
        $threadTitle = $row['thread_title'];
        $threadDesc = $row['thread_desc'];
        echo '<div class="d-flex align-items-center my-2">
        <div class="flex-shrink-0">
        <img src="https://source.unsplash.com/100x80/?nature,water" alt="...">
      </div>
      <div class="flex-grow-1 ms-3">
      <p><b>'. $threadTitle .'</b></p>
        <a href="comments.php?threadId=' .$threadId .'" class="text-success">'. $threadDesc .'</a>
        <p> asked by: '. $row3['email'] .'</p>
      </div>
    </div>';
    }

    if($noRecord == true){
        echo "No Results Found . Be the First to ask a question ";
    }
    ?>
     

      

    </div>
    <?php include 'components/footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->
</body>

</html>