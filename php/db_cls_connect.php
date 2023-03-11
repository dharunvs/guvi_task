<?php

require __DIR__ . "/vendor/predis/predis/autoload.php";


    // Predis\Autoloader::register();
    
    // $redis = new Predis\Client(array(
    //   "scheme" => "tcp",
    //   "host" => "localhost",
    //   "port" => "6379",
    //   // "password" => "061297"
    //   ));

    $parameters = [
        'tcp://127.0.0.1:6379?alias=master',
        // 'tcp://127.0.0.1:6380?alias=slave',
    ];
    
    $client = new Predis\Client($parameters, ['replication' => "predis", 'prefix' => 'sessions:']);
    $handler = new Predis\Session\Handler($client);
    $handler->register();


session_start();

Class dbObj{

    var $servername = "localhost";
    var $username = "root";
    var $password = "Dharun@123";
    var $dbname = "guvi";

    var $conn;
    function getConnstring() {
        $con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());
        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->conn = $con;
        }
    return $this->conn;
  }
}
?>