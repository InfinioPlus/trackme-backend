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
    $query1 = "UPDATE users SET latitudes = $lat_, longitudes = $long_, last_update = NOW() WHERE id = '$phone_id'";
    mysqli_query($conn, $query1) OR die($conn_error);
    $query2 = "SELECT channel FROM users WHERE id = '$phone_id'";
    $arr = array();
    if($query_run = mysqli_query($conn,$query2))
    {
	while($query_row = mysqli_fetch_assoc($query_run))
	{
		$arr['channel'] = $query_row['channel'];				
	}				
    }
    echo json_encode($arr);
    }
	


?>
