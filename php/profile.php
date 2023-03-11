<?php
    header("Access-Control-Allow-Origin: *");
    require "../vendor/autoload.php";

    // $DATABASE_HOST = 'localhost';
    // $DATABASE_USER = 'root';
    // $DATABASE_PASS = 'root';
    // $DATABASE_NAME = 'guvi';

    // $connection = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    // if(mysqli_connect_errno()){
    //     exit("Failed to connect = ".mysqli_connect_error());
    // }

    $connString = "mongodb+srv://dharunvs:Sharon_123@guvi.hdlskyb.mongodb.net/?retryWrites=true&w=majority";
    $client = new MongoDB\Client($connString);
    $userColl = $client -> guvi -> users;

    // $redis = new Redis();
    // $redis->connect('127.0.0.1', 6379); 
    // ini_set('session.save_handler', 'redis');
    // ini_set('session.save_path', 'tcp://127.0.0.1:6379');
    // session_start();
    
    // echo "redis ". $redis->ping();
    
?>

