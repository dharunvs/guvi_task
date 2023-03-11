<?php 
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379); 
    ini_set('session.save_handler', 'redis');
    ini_set('session.save_path', 'tcp://127.0.0.1:6379');
    session_start();
    $sess_data =$redis->get(session_id());
    $redis->del($sess_data);
    echo 'done';

?>