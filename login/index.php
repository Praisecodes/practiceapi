<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

    require_once "../connection.php";

    $content_type = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "Not Set";
    $username = null; $password = null;

    if($content_type === "application/json"){
        $contents = trim(file_get_contents("php://input"));

        $decoded = json_decode($contents, true);

        $username = testInput($decoded["username"]);
        $password = testInput($decoded["password"]);
        
        echo json_encode([
            "Username" => $username,
            "Password" => $password
        ]);
    }
    else{
        echo json_encode([
            "Not JSON Format"
        ]);
    }

    function testInput($data){
        $data = stripslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }
?>