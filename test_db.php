<?php

// $host = 'localhost';   
// $db   = 'cocomelo_database';          
// $user = 'cocomelo_user';         
// $pass = '#jO09786#';          

$host ='103.195.185.115';

$db   = 'cocomelo_database';          
$user = 'cocomelo_user';         
$pass = '#jO09786#';  


// $host = '193.203.184.46';   
// $db   = 'u341962139_crud';          
// $user = 'u341962139_crud_user';         
// $pass = "0nly@Demo";   

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
