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
    


    <div class="container jumbo my-2 pt-5 pb-4">
         <h1> Search Results for <?php echo $_GET['search'] ?>  </h1>
        <!-- <p class="lead"><?php echo $category ?></p> -->
    </div>
    
    <!-- <br> -->

    
    <br>
    <div class="container my-3 ">
    <h2 my-2>Results</h2>
    <?php
        $query = $_GET['search'];
        $sql = "select * from thread_questions where match (thread_title , thread_desc) against ('$query')";
        $result = mysqli_query($conn , $sql);
        $noresult=true;
        while($row = mysqli_fetch_assoc($result)){
            $threadId = $row['thread_id'];
            $noresult = false;
            // echo $row['thread_desc'];
            echo '
            <div class="container my-2 py-0">
            <p class ="lead"> <a class="text-dark" >'. $row['thread_title'] .' </a></p>
            <p class =""> <a class="text-success" href="comments.php?threadId=' .$threadId .' ">'. $row['thread_desc'] .' </a></p>
            </div>';
            
        }
        if($noresult){
            echo "No Results Found";
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