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
    .jumbo {
        /* border: 1px solid black; */
        border-radius: 4px;
        background-color: rgba(212, 241, 212, 0.889);
    }

    .jumbo h1 {
        font-size: 50px;
    }
    </style>
</head>

<body>

    <?php
    include 'components/dbconnect.php'; ?>
    <?php include 'components/header.php'; ?>
    <?php
    $id= $_GET['threadId'];
    $sql = "SELECT * FROM `thread_questions` WHERE `thread_id`=' $id '";
    $result = mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($result);
        $sn = $row['user_id'];
        $title = $row['thread_title'];

        $desc = $row['thread_desc'];
        // echo $title;
        // echo $desc;

    
    
    ?>

    <?php
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
        $sno = $_SESSION['sno'];
        if($_SERVER['REQUEST_METHOD']== "POST"){
            // echo "comment posted";
            $name = $_POST['name'];
            $solution = $_POST['solution'];
            $sql4 = "INSERT INTO `comments` ( `comm_loader_name`, `comm_solution`, `user_id`, `thread_id`) VALUES ( '$name', '$solution ', '$sno', '$id' )";
            $result = mysqli_query($conn , $sql4);
        }
    }
?>
<?php
    $usersql = "SELECT * FROM `signup_data` WHERE `sno`= '$sn'";
    $query_fire = mysqli_query($conn, $usersql);
    $row5= mysqli_fetch_assoc($query_fire);
    echo ' <div class="container jumbo my-2 pt-5 pb-4">
    <h1> '. $title .' Forums </h1>
    <p class="lead">'.  $desc .'</p>
    <div class="container">
        <p> <b> Asked by-'. $row5['email'] .' </b> </p>
    </div>
</div>';
?>
    

    <br>

    <div class="container">
        <h2 class="my-2">Answer this Problem</h2>

        <?php
           if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
            echo '<form action="'. $_SERVER['REQUEST_URI'].' " method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name </label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="solution" class="form-label">problem Solution</label>
                <textarea class="form-control" aria-label="With textarea" id=" solution" name=" solution"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Upload Your Solution</button>
        </form>';   
           }
           else{
               echo '        <p class="lead">Kindly Login to Post comments</p>';
           }
        ?>
    </div>

    <br>

    <div class="container my-3 ">
        <h2 my-2>Discussion</h2>
        <?php
// $sno = $_SESSION['sno'];


    $sql = "SELECT * FROM `comments` WHERE `thread_id`= '$id'";
    $result= mysqli_query($conn , $sql);
    while($row= mysqli_fetch_assoc($result)){
        $sn = $row['user_id'];
        $usersql = "SELECT * FROM `signup_data` WHERE `sno`= '$sn'";
         $query_fire = mysqli_query($conn, $usersql);
        $row5= mysqli_fetch_assoc($query_fire);
        $solve = $row['comm_solution']; 
        $name = $row['comm_loader_name'];
        echo '
        <div class="d-flex align-items-center my-2">
        <div class="flex-shrink-0">
        <img src="https://source.unsplash.com/100x80/?nature,water" alt="...">
      </div>
      <div class="flex-grow-1 ms-3"> 
      
      <p> '. $solve .' </p>
      <p> wriiten by <b>'. $name.' </b>
      <p> with user ID <b>'. $row5['email'] .' </b></div>
      </div>'; 
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