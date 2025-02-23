<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email1"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $_SESSION["login_error"] = "Írd be az emailt és a jelszót!";
        header("Location: loginform.php");
        exit();
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
                header("Location: index.php");
                exit();
            } else {
                $_SESSION["login_error"] = "Hibás jelszó!";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION["login_error"] = "Nincs ilyen felhasználó!";
            header("Location: index.php");
            exit();
        }

        $stmt->close();
        $conn->close();
    }
}
?>