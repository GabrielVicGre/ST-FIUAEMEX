<?php
/*
    $user = "Administrador@sbd1-tutoria";
    $password = "3Fl760wnL8b";
    $server = "sbd1-tutoria.mysql.database.azure.com";
    $database = "bd_sistematutoria";
    //Initializes MySQLi
    $connection = mysqli_init();
   // mysqli_ssl_set($connection,NULL,NULL, $ruta.'/Assets/SSL/BaltimoreCyberTrustRoot.crt.pem', NULL, NULL);
    // Establish the connection
    mysqli_real_connect($connection,$server,$user,$password,$database, 3306, NULL, MYSQLI_CLIENT_SSL);

    if (mysqli_connect_errno()) {
        die('Failed to connect to MySQL: '.mysqli_connect_error());
    }
*/


  
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "bd_sistematutoria";

    $connection = new mysqli($host, $user, $pass, $db);
    $connection->set_charset("utf8");

    if ($connection->connect_errno) {
        die("la conexión ha fallado: " . $connection->connect_error);
    }

 /*  

$host = "localhost";
$user = "cnopedom_acttu";
$pass = "ev3ryS@und";
$db = "cnopedom_acttu";

$connection = new mysqli($host, $user, $pass, $db);
if ($connection->connect_errno) {
    echo "Falló la conexión a la base de datos";
}*/

