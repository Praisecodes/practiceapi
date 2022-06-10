<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");

    require_once "connection.php";

    $content_type = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "Not Set";
    $fullname = null; $username = null; $confirm_password = null; $password = null;

    if($content_type === "application/json"){
        $contents = trim(file_get_contents("php://input"));

        $decoded = json_decode($contents, true);
        $fullname = TestInput($decoded["fullname"]);
        $username = TestInput($decoded["username"]);
        $confirm_password = TestInput($decoded["confirm_password"]);
        $password = TestInput($decoded["password"]);

        $sql = "INSERT INTO user_details(fullname, username, userpassword) VALUES(?,?,?);";

        if($confirm_password === $password){
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $fullname, $username, $password);

            if($stmt->execute()){
                echo json_encode([
                    "Success"
                ]);
                $stmt->close();
                $conn->close();
                exit;
            }
            else{
                echo json_encode([
                    "A problem has occured\nPlease contact server side engineer"
                ]);
                $stmt->close();
                $conn->close();
                exit;
            }
        }
        else{
            echo json_encode([
                "Passwords Do Not Match!!"
            ]);
            exit;
        }
    }
    else{
        echo json_encode([
            "Not JSON Format!!"
        ]);
        exit;
    }


    function TestInput($data){
        $data = stripslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);

        return $data;
    }
?>