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
    if ($conn){
        
        // Get data
        $phone_id = $_GET["guid"];
        $lat_ = $_GET["lat"];
        $long_= $_GET["lng"];
        
        // Update user data 
        $query1 = "UPDATE users SET latitudes = $lat_, longitudes = $long_, last_update = NOW() WHERE id = '$phone_id'";
        mysqli_query($conn, $query1) OR die($conn_error);
        
        // Get user channel
        $channel = '';
        $query2 = "SELECT channel FROM users WHERE id = '$phone_id'";
        if($query_run = mysqli_query($conn,$query2)){
            // Getting just the first result, no more
            if($query_row = mysqli_fetch_assoc($query_run)){
                $channel = $query_row['channel'];				
            }				
        }
        
        $arr = array();
        
        // Getting all the informtion of users in the same channel
        $query3 = "SELECT * FROM users WHERE channel = '$channel'";
        
        if($query_run = mysqli_query($conn,$query3)){
            while($query_row = mysqli_fetch_assoc($query_run)){
                $arry = array();
                $arry['longitudes'] = $query_row['longitudes'];
                $arry['latitudes'] = $query_row['latitudes'];
                $arry['last_update'] = $query_row['last_update'];
                array_push($arr,$arry);
            }
        }
        
        // Output data depending if it is cross domain call or normal call
        if (isset($_GET["callback"])){
            echo $_GET["callback"] . '(' . json_encode($arr) . ')';
        }	 
        else{
            echo json_encode($arr);
        }
    }
    
?>
