<?php
    if(isset($_GET["id"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["roles"])){
        $filename = 'result.json';
        echo $_GET["id"];

        if(file_exists($filename)){
            $current_data = file_get_contents($filename);
		    $array_data = json_decode($current_data, true);

            for($i = 0; $i < sizeof($array_data); $i++){
                if($array_data[$i]["id"] == $_GET["id"]){
                    $array_data[$i]["username"] = $_POST["username"];
                    $array_data[$i]["email"] = $_POST["email"];
                    $array_data[$i]["password"] = $_POST["password"];
                    $array_data[$i]["roles"] = $_POST["roles"];
                }
            }
            
            $final_data = $array_data;
        } else {
            $data = array('id'=> 1, 'username'=> $_POST["username"], 'email'=> $_POST["email"], 'password'=> $_POST["password"], 'roles'=> $_POST["roles"]);
            $final_data[] = $data;
        }

        $handle = fopen($filename, 'w');
        fwrite($handle, json_encode($final_data));
        fclose($handle);
    }

    $url = "index.php";
    header('Location: '.$url);
?>