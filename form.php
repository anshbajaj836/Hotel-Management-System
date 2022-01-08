<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Rgister Customer</title>
  
  <style>
    .check_out{
      position:relative;
      right : 200px;
    }
  </style>
  
  
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">HMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/project1/mainpage.php/">Home</a>
        </li>
        
        <li><a class = 'nav-customer nav-link'href="/project1/form.php/">Register Customer</a></li>
        
      </ul>
      
    </div>
  </div>
</nav>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "hms_users";
    //connect irrespective of submission or not

    $conn = mysqli_connect($servername , $username , $password ,$database );
    if($conn ) {
        echo "connection successfull!" ;
    }else {
        die ("connection error !".mysqli_connect_error());
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $aadhar_no = $_POST['aadhar_no'];
        $living_room =$_POST['living_room'];
        $conference_room =$_POST['conference_room'];
        $party_room =$_POST['party_room'];

        // if(strlen($aadhar_no)!=12 || strlen($name) > 32 || strlen($address)>256){
        //     die ("Data you have entered is not in correct form or have exceeded the character limit".msqli_connect);
        // }

        //inserting values
        $sql  ="INSERT INTO `customer` (`name`, `aadhar`, `address`) VALUES ('$name', '$aadhar_no', '$address')";
        $res = mysqli_query($conn , $sql );

        if($res) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your data has been submitted succesfull.
       
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        close <span aria-hidden="true">×</span>
        </button>
      </div>';
        }else{
            die ("data not submitted".mysqli_error($conn));
        }
    }
    
?>

<div  class="container mt-3 p-3 mb-2 bg-secondary text-white">
<h1>Register new customer</h1>
    <form action="/Project1/form.php" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
        
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address">
    </div>
    <div class="form-group">
        <label for="aadhar_no">Aadhar Number:</label>
        <input type="int" name="aadhar_no" class="form-control" id="aadhar_no"  length="12">
    </div>
    
    
    
error_reporting(E_ERROR | E_WARNING | E_PARSE);

    <!-- <div class="form-group">
        <label for="living_room">Living Room</label>
        <small id="leftrooms" class="form-text">Rooms left:  Price:</small>
        <input type="number" style="width: 200px;" placeholder="No. of Rooms:" name="living_room" class="form-control" id="living_room" />  
              
    </div>
    <div class="form-group">
        <label for="conference_room">Conference Room</label>
        <small id="leftrooms" class="form-text">Rooms left:  Price:</small>
        <input type="number" style="width: 200px;" placeholder="No. of Rooms:" name="conference_room" class="form-control" id="conference_room" aria-describedby="emailHelp">        
    </div>
    <div class="form-group">
        <label for="party_room">Party Room</label>
        <small id="leftrooms" class="form-text">Rooms left: <?php echo "5" ?>  Price:</small>
        <input type="number" style="width: 200px;" placeholder="No. of Rooms:" name="party_room" class="form-control" id="party_room" aria-describedby="emailHelp">        
    </div>

    <div class="form-group">
      <label for="check_in">Check in:</label>  
      <input type="date" name="check_in" style="border-style: inset; border-radius: 5px" placeholder=getDate() />
      <label for="check_out">Check out:</label>  
      <input type="date" name="check_out" style="border-style: inset; border-radius: 5px"  placeholder=getDate() />
  -->
    </div>
    <div class="form-group">
    <input type="submit" name="run" value="Submit" class="btn btn-secondary btn-outline-light"/>
    <input type="reset" class="btn btn-secondary btn-outline-light"/>
    </div> 
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>