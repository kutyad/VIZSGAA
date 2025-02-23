<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
header("Content-Type: application/json");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "db.php";

$method = $_SERVER["REQUEST_METHOD"];
$input = json_decode(file_get_contents("php://input"), true);

$endpoint = $_GET["endpoint"] ?? "";

switch ($endpoint) {
    case "register":
        if ($method === "POST") {
            $username = $input["username"] ?? "";
            $email = $input["email"] ?? "";
            $password = $input["password"] ?? "";
            $confirm_password = $input["confirm_password"] ?? "";

            $errors = [];

            if (empty($username)) {
                $errors["username"] = "Meg kell adnod egy felhasználó nevet!";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Az email formátuma nem megfelelő!";
            }
            if (empty($password) || strlen($password) < 6) {
                $errors["password"] = "A jelszónak legalább 6 karakterből kell állnia!";
            }
            if ($password !== $confirm_password) {
                $errors["confirm_password"] = "A jelszavak nem egyeznek!";
            }

            if (empty($errors)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $conn = getDatabaseConnection();
                $sql = "CALL RegisterUser(?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $hashed_password);

                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "Sikeres regisztráció!"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Hiba: " . $stmt->error]);
                }

                $stmt->close();
                $conn->close();
            } else {
                echo json_encode(["success" => false, "errors" => $errors]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid request method"]);
        }
        break;

    case "login":
        if ($method === "POST") {
            $email = $input["email"] ?? "";
            $password = $input["password"] ?? "";

            if (empty($email) || empty($password)) {
                echo json_encode(["success" => false, "message" => "Írd be az emailt és a jelszót!"]);
            } else {
                $conn = getDatabaseConnection();
                $sql = "CALL LoginUser(?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $user = $result->fetch_assoc();
                    if (password_verify($password, $user["password"])) {
                        $_SESSION["user_id"] = $user["user_id"];
                        $_SESSION["username"] = $user["username"];
                        $_SESSION["is_admin"] = $user["is_admin"];
                        echo json_encode(["success" => true, "message" => "Sikeres bejelentkezés!"]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Hibás jelszó!"]);
                    }
                } else {
                    echo json_encode(["success" => false, "message" => "Nincs ilyen felhasználó!"]);
                }

                $stmt->close();
                $conn->close();
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid request method"]);
        }
        break;

    default:
        echo json_encode(["success" => false, "message" => "Invalid endpoint"]);
        break;
}
?>