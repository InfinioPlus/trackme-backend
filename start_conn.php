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
        //On connection

        $id_ = $array["guid"];
        $lat_ = $_GET["lat"];
        $long_= $_GET["long"];
        $query = "INSERT INTO users (id,latitudes,longitudes,last_update) VALUES ('$id_',$lat_,$long_, NOW())";
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
	
