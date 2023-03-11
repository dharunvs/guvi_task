<?php
  header("Access-Control-Allow-Origin: *");
  require "../vendor/autoload.php";

  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'root';
  $DATABASE_PASS = 'root';
  $DATABASE_NAME = 'guvi';

  $connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
  if(mysqli_connect_errno()){
      exit("Failed to connect = ".mysqli_connect_error());
  }

  $connString = "mongodb+srv://dharunvs:Sharon_123@guvi.hdlskyb.mongodb.net/?retryWrites=true&w=majority";
  $client = new MongoDB\Client($connString);
  $userColl = $client -> guvi -> users;

  if ( !isset($_POST['email'], $_POST['password'], $_POST['cpassword'], $_POST['fname'], $_POST['lname']) ) {
    exit('Please fill all fields!');
  }

  if($query = $connection->prepare('select email from users where (email = ?)')){
    $query->bind_param('s', $_POST["email"]);
    $query->execute();
    $query->store_result();
    if($query->num_rows == 0){
      if($query = $connection->prepare('insert into users (email, password) values (?, ?);')){
        $query->bind_param("ss", $_POST["email"], $_POST["password"]);
        $query->execute();
        if($query->store_result()){
          $query = $connection->prepare('select id from users where (email = ?);');
          $query->bind_param("s", $_POST["email"]);
          $query->execute();
          $query->bind_result($id);
          $query->fetch();
          $cursor = $userColl -> insertOne([
            "fname" => $_POST["fname"],
            "lname" => $_POST["lname"],
            "_id" => $id,
          ]);
        }
        
        echo "Success";
      }
    } else {
      echo "Email already exists";
    }
  }

  
  
  

  
 
?>  