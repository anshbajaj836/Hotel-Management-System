<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>HMS</title>
    <!-- <style>
      .body{
        text-align : center;
      }
    </style> -->
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
          <a class="nav-link active" aria-current="page" href="/project1/query1.php/">Home</a>
        </li>
        
        <!-- <li><a class = 'nav-customer nav-link'href="/project1/form.php/">Register Customer</a></li> -->
      </ul>
    </div>
  </div>
</nav>



<div style="text-align:center;" class="p-3 mb-2 bg-secondary text-white">
    <form action="" method="POST">
                <h2>Please select the query to be executed</h2><br>
                <select name="quary" >
                    <option value="">--select--</option>
                    <option value="1">Print the details of all the customers.</option>
                    <option value="2">Find the status of each room.</option>
                    <option value="3">Print the cost of each type of room.</option>
                    <option value="4">Print how many rooms of each type are booked.</option>
                    <option value="5">Print the amount paid for each bill_id.</option>
                    <option value="6">Bank details of customer staying/stayed in Room number 1.</option>
                    <option value="7">Print the no. of rooms which are left in each category</option>
                    <option value="8">Count the no. of customers.</option>
                    <!--<option value="9">Print the cost of each type of room.</option> -->
                    
                </select>
                <input type="submit" name="run" class="btn btn-secondary btn-outline-light" value="Result"/><br>
            </form>

    </div>

<?php



 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "hms_users";
 //connect irrespective of submission or not
 
 $conn = mysqli_connect($servername , $username , $password ,$database );



error_reporting(E_ERROR | E_WARNING | E_PARSE);


    $select = $_POST['quary'];
    if(isset($_POST['run'])){
        switch($select){
            case 1:
              $sql = "SELECT * FROM `customer`";
              $res = mysqli_query($conn, $sql); 
              
              foreach($res as $element)
                    {
                  echo "Customer ID: ". $element["cust_id"] . "<br>";
                  echo "Name: ". $element["name"] . "<br>";
                  echo "Address: ". $element["address"] . "<br>";
                  echo "Aadhar No.: ". $element["aadhar"] . "<br>";
                  echo "<br>";
                    }
                break;
            
            case 2:
                  $sql = " SELECT room_no , status FROM room;";
                  $res = mysqli_query($conn, $sql);
              
                  foreach($res as $element) {
                   if($element['status'])
                    $t = "Filled";
                  else 
                      $t = "Empty";
                    

                  echo "Room no." . $element['room_no'] ." is ". $t;
                  echo "<br>";
                  }
                  break;
             case 3:
              $sql = "SELECT DISTINCT type, cost FROM room;";
              $res = mysqli_query($conn, $sql);
              foreach($res as $element)
              {
            echo "Room Type: ". $element["type"] ; 
            echo "<br>Cost: " . $element["cost"]. "<br>";
            echo "<br>";
              }
          break;
            
          case 4:
            $sql = "SELECT type, COUNT(room_no) AS ct
            FROM room
            WHERE status = 1
            GROUP BY type;";

            $res = mysqli_query($conn, $sql);

            foreach ($res as $element) {
              echo "Room type: " . $element['type'] ;
              echo "<br>No. of rooms already in use: ". $element['ct'];
              echo "<br>";
              echo "<br>";
            }
          
            break;

          case 5:
            $sql = "SELECT bill_no, amount, cust_id
            FROM bill;";
            $res = mysqli_query($conn, $sql);
            
            foreach ($res as $element) {
              echo "Cust_id: ". $element['cust_id'] ;
              echo "<br>Bill Number: ". $element["bill_no"];
              echo "<br>Bill Amount: ". $element['amount'];
              echo "<br> <br>";
            }
            
            break;
          
          case 6:
            // echo '<form action="" method="POST" >
            // <select   name = "abc" >
            // <option selected>Open this select menu</option>
            // <option  value="1">One</option>
            // <option  value="2">Two</option>
            // <option  value="3">Three</option>
            // <option  value="4">Four</option>
            // <option  value="5">Five</option>
            // <option  value="6">Six</option>
            //  </select>
            // <input name="click" class="btn btn-secondary btn-outline-light" value="Submit" type="submit"/>
            // </form>' ;
            
            // error_reporting(E_ERROR | E_WARNING | E_PARSE);

            // if(isset($_POST['click'])){
            //   $temp = $_POST['abc'];
            //   echo "no. is selected succesfully <br>";
            //   echo $temp;
            // }
            // else{
            //   echo 'There is an error.';
            // }

            $sql ="SELECT `bank`.* , `stay_period`.`chechin`, `stay_period`.`chechout`
            FROM bank, stay_period
            WHERE bank.cust_id = stay_period.cust_id AND stay_period.cust_id IN (SELECT cust_id
                                                                                 FROM stay_room, stay_period
                                                                                 WHERE stay_room.booking_id = stay_period.booking_id AND room_no = 1);
                                                                                 " ;

            $res = mysqli_query($conn, $sql);

            foreach ($res as $element) {
              echo "Customer Id: ". $element['cust_id'] . "<br>Account Number: ". $element['account_no']. "<br>Bank Name: ". $element['bank_name'] . "<br>IFSC Code: " . $element['ifsc_code'] . "<br>Check In: " . $element['chechin'] . "<br>Check Out: " . $element['chechout'] . "<br> <br>";
            }
          
            
            break;

            case 7:
                $sql = "SELECT type, COUNT(room_no) AS ct
                FROM room
                WHERE status = 0
                GROUP BY type;";
    
                $res = mysqli_query($conn, $sql);
    
                foreach ($res as $element) {
                  echo "Room type: " . $element['type'] ;
                  echo "<br>No. of rooms already free: ". $element['ct'];
                  echo "<br>";
                  echo "<br>";
                }
              
                break;
      
          case 8:
              $sql = "SELECT * FROM customer";
              $res = mysqli_query($conn, $sql);
              if($res = mysqli_query($conn, $sql))
              {
                $count = mysqli_num_rows($res);
                echo "Total number of customers: " .$count;
              }
              
              break;

            default:
                echo "Please select an option";
        }
    }

 ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>