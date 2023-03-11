<?php
    header("Access-Control-Allow-Origin: *");

    include_once("db_cls_connect.php");
    $db = new dbObj();
    $connString =  $db->getConnstring();

    $params = $_REQUEST;
    $action = $params['action'] !='' ? $params['action'] : ''; 

    // require_once __DIR__ . '/vendor/autoload.php';
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
    
    $client = new Predis\Client($parameters, ['replication' => true, 'prefix' => 'sessions:']);
    $handler = new Predis\Session\Handler($client);

    // echo "Connected to Redis";

    // $redis->set("foo", "bar");

    // define("SITE_ROOT", __DIR__);

    // $m = new MongoClient();


    $user = new User($connString);


    switch($action) {
        case 'login':
            $user->login();
            break;
        default:
            return;
    }

    class User {
        protected $conn;
        protected $data = array();
        function __construct($connString) {
            $this->conn = $connString;
        }
    
         
    function login() {
      

            $user_email = trim($_POST['email']);
            $user_password = trim($_POST['password']);

            $sql = "SELECT idusers, email, password FROM users WHERE email='$user_email'";
            $resultset = mysqli_query($this->conn, $sql) or die("database error:". mysqli_error($this->conn));
            $row = mysqli_fetch_assoc($resultset);

            printf(md5($user_password), $row['password']);

            if(md5($user_password) == $row['password']){
                
                echo "1";
                $_SESSION['user_session'] = $row['email'];
            } else {
                echo "Ohhh ! Wrong Credential."; // wrong details
            }
        
    }

}
    


  
?>

