<?php


    // Connect to database

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $conn_error = 'Could Not Connect';
    $dbname = "trackme";
    // Create connection

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check connection

    if ($conn) {
    
	    $phone_id = $_GET["guid"];
	    $lat_ = $_GET["lat"];
        $long_= $_GET["lng"];
		$query = "UPDATE users SET latitudes = $lat_, longitudes = $long_, last_update = NOW() WHERE id = $phone_id";
        mysqli_query($conn, $query) OR die($conn_error);		
    }



?>