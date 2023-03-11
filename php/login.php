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

    // $connString = "mongodb+srv://dharunvs:Sharon_123@guvi.hdlskyb.mongodb.net/?retryWrites=true&w=majority";
    // $client = new MongoDB\Client($connString);
    // $userColl = $client -> guvi -> users;

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379); 
    ini_set('session.save_handler', 'redis');
    ini_set('session.save_path', 'tcp://127.0.0.1:6379');
    session_start();

    if ( !isset($_POST['email'], $_POST['password']) ) {
        exit('Please fill all fields!');
    }

    if ($query = $connection->prepare('select password from users where (email = ?);')){
        $query->bind_param('s', $_POST["email"]);
        $query->execute();
        $query->store_result();
        if($query->num_rows() > 0){
            $query->bind_result($password);
            $query->fetch();
            if($password == $_POST["password"]){
                $redis->set(session_id(), $_POST["email"]);
                echo session_id();
            }
        } else {
            echo "Email does not exist";
        }
    }
    
?>

