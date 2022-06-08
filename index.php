<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");

    $content_type = isset($_SERVER["CONTENT-TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "Not Set";

    if($content_type === "application/json"){
        $contents = trim(file_get_contents("php://input"));

        $decoded = json_decode($contents, true);

        echo json_encode($decoded);
    }
    else{
        echo json_encode([
            "Not JSON Format"
        ]);
    }
?>