<?php
    require_once "headers.php";
    require_once "connection.php";

    $content_type = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : "Not Set";
    $username = null; $password = null; $mainPassword = null;

    if($content_type === "application/json"){
        $contents = trim(file_get_contents("php://input"));

        $decoded = json_decode($contents, true);

        $username = testInput($decoded["username"]);
        $password = testInput($decoded["password"]);
        
        $sql = "SELECT userpassword FROM user_details WHERE username = ?;";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);

        if($stmt->execute()){
            $result = $stmt->get_result();

            if($result->num_rows > 0){
                while($rows = $result->fetch_assoc()){
                    $mainPassword = $rows["userpassword"];
                }

                if($password === $mainPassword){
                    echo json_encode([
                        "Success"
                    ]);
                    $stmt->close();
                    $conn->close();
                    exit;
                }
                else{
                    echo json_encode([
                        "Password Mismatch!"
                    ]);
                    $stmt->close();
                    $conn->close();
                    exit;
                }
            }
            else{
                echo json_encode([
                    "No Such User Found"
                ]);
                $stmt->close();
                $conn->close();
                exit;
            }
        }
        else{
            echo json_encode([
                "Fatal Error!!\nPlease Contact Server Side Engineer"
            ]);
            $stmt->close();
            $conn->close();
            exit;
        }
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