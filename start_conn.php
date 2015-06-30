<?php 

	function GUID()
	{
	    if (function_exists('com_create_guid') === true)
	    {
	        return trim(com_create_guid(), '{}');
	    }

	    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}

	
	$array = array("guid" => GUID(),"response"=>http_response_code());

	if (isset($_GET["callback"])){
	echo $_GET["callback"] . '(' . json_encode($array) . ')';
	}	 
	else{
		echo json_encode($array);
	}

	// Connect to database

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$conn_error = 'Could Not Connect';
	$dbname = "trackme";
	// Create connection
	
   	$conn = mysqli_connect($host, $user, $pass, $dbname);
	
	// Check connection
	
   	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	
	//On connection
	
	$id_ = $array["guid"];
	$lat_ = $_GET["lat"];
	$long_= $_GET["long"];
	$phone_id = $GET["pid"];
	$last_update = $_GET["last_seen"];
	$query = "INSERT INTO trackme (id,phone_id,latitudes,longitudes,last_update) VALUES ($id_,$phone_id,$lat_,$long_,$last_update)";
	if (mysqli_query($conn, $query)) 
	{
    	echo "New record created successfully";
	} 
	else 
	{
    	echo "Error: " . $query . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
?>
	
