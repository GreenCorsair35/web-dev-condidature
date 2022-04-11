<?php
    if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["roles"])){
        $filename = 'result.json';

        if(file_exists($filename)){
            $current_data = file_get_contents($filename);
		    $array_data = json_decode($current_data, true);

            $last_item = end($array_data);
            $last_item_id = $last_item['id'];

            $array_data[] = array('id'=> ++$last_item_id, 'username'=> $_POST["username"], 'email'=> $_POST["email"], 'password'=> $_POST["password"], 'roles'=> $_POST["roles"]);
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