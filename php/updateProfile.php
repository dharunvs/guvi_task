<?php 

header("Access-Control-Allow-Origin: *");
    require '../vendor/autoload.php';
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379); 
    ini_set('session.save_handler', 'redis');
    ini_set('session.save_path', 'tcp://127.0.0.1:6379');
    session_start();
    $connString = "mongodb+srv://dharunvs:Sharon_123@guvi.hdlskyb.mongodb.net/?retryWrites=true&w=majority";
    $client = new MongoDB\Client($connString);
    $collection = $client -> guvi -> users;
    
    $sess_data =$redis->get(session_id());
    if(isset($sess_data)){
         $id = $redis->get($sess_data);
         $cursor = $collection->updateOne(
            ['_id' => intval($id)],
            ['$set'=>[
                "email" => $sess_data,
                "fname" => $_POST['fname'],
                "lname" => $_POST['lname'],
                "age" => $_POST['age'],
                "dob" => $_POST['DOB'],
                "phone" => $_POST['phone'],
            ]]
        );
        echo "Success";
    } else {
        echo "some error";
      }


?>