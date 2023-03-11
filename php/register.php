<?php
    header("Access-Control-Allow-Origin: *");

    // require_once __DIR__ . '/vendor/autoload.php';
    require __DIR__ . "/vendor/predis/predis/autoload.php";


    Predis\Autoloader::register();
    
    $redis = new Predis\Client(array(
      "scheme" => "tcp",
      "host" => "localhost",
      "port" => "6379",
      // "password" => "061297"
      ));

    // echo "Connected to Redis";

    // $redis->set("foo", "bar");

    // define("SITE_ROOT", __DIR__);

    // $m = new MongoClient();

    $servername = "localhost";
    $username = "root";
    $password = "Dharun@123";
    $dbname = "guvi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    } 

    

  //   $client = new MongoDB\Client();
  // $db = $client->test;


//   $client = new MongoDB\Driver\Manager(
//     'mongodb+srv://dharunvs:Sharon_123@guvi.hdlskyb.mongodb.net/?retryWrites=true&w=majority'
// );

    $formData = $_POST;

    

    

      $signedAlready = false;

      $sql = sprintf("SELECT email FROM users;");
      if ($result = $conn -> query($sql)) {
        while ($row = $result -> fetch_row()) {
          if($row[0] == $formData["email"]){
            $signedAlready = true;
          };
          
        }
        $result -> free_result();
      }

      if(!$signedAlready){


          $sql = sprintf("INSERT INTO users (email, password) VALUES ('%s', '%s');", $_POST["email"], $_POST["password"]);
            if (mysqli_query($conn, $sql)) {
              echo "success";
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
      
      
      } else {
        echo "already_registered";
      }

  
?>

