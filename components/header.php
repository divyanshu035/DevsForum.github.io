<?php

session_start();


echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">Navbar</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

        
            $sql = "SELECT * FROM `forum_table` LIMIT 3";
            $result = mysqli_query($conn , $sql);
            while($row= mysqli_fetch_assoc($result)){
              $id = $row['id'];
              echo '<li><a class="dropdown-item" href="threadlist.php?Id='.$id .'">'. $row['name'] .'</a></li>';
              
            }

        


        echo '
         
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="contacts.php" tabindex="-1" >Contact Us</a>
      </li>
    </ul>
    <form class="d-flex" action="forums/search.php" method="get">
      <input class="form-control me-2" name="search" id="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit"  >Search</button>
    </form>
  </div>';
  
  if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true){
    echo '<p class="mx-2 my-0"> Logged in as <b> '.$_SESSION['email'] .' </b> </p> 
    <a href="/forums/components/logout.php" class="btn btn-outline-success mx-2 mr-0">logout</a>';

  }
  else{

    echo '
    <button class="btn btn-outline-success mx-2 mr-0" data-bs-toggle="modal" data-bs-target="#loginModal">login</button>
    <button class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
    </div>';
  }
echo '</nav>';





?>

<?php include 'components/loginModal.php'; ?>
<?php include 'components/signupModal.php'; ?>
<?php  
    if(isset($_GET['successSignup']) && $_GET['successSignup'] == true){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>success !</strong> you have signed up successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  // echo $_GET['successSignup'];
  // $_GET['successSignup']=false;
  // echo var_dump($_GET['successSignup']);

    } if(isset($_GET['pass_error']) && $_GET['pass_error'] == true){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>ERROR !</strong> Passwords do not match.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    } if(isset($_GET['invalid']) && $_GET['invalid'] == true){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>ERROR !</strong> please try again with username.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
     

    if(isset($_GET['login']) && $_GET['login'] == true){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>success !</strong> you are logged in successfully.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>'; 
    }
    // else{
    //   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //   <strong>ERROR !</strong> Invalid Credentials,
    //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    // </div>';
    // }
    ?>