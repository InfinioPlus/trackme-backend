<?php 

    // Connect to database
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $conn_error = 'Could Not Connect';
    $dbname = "trackme";
    
    // Create connection
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    $array = array();
    
    // Check connection
    if ($conn) {
        //On connection
        $guid = mysqli_real_escape_string($conn,$_GET["guid"]);
        $query = "DELETE FROM users WHERE id='$guid'";
        
        if (mysqli_query($conn, $query)) 
        {
            // 1 means successfully conected and the user can continue
            $array['connection_status'] = '1';
        } 
        else 
        {
            //something unexpected happen
            $array['connection_status'] = '2';
        }
        mysqli_close($conn);
    	} else{
        	//something unexpected happen
        	$array['connection_status'] = '2';
    	}
    
   
    // output the results
    if (isset($_GET["callback"])){
        echo $_GET["callback"] . '(' . json_encode($array) . ')';
    }	 
    else{
        echo json_encode($array);
    }
?>