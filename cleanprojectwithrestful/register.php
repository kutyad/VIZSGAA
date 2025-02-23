<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "db.php";

$_SESSION["username_error"] = "";
$_SESSION["email_error"] = "";
$_SESSION["password_error"] = "";
$_SESSION["confirm_password_error"] = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["psw"];
    $confirm_password = $_POST["psw-repeat"];
    $error = false;

    if (empty($username)) {
        $_SESSION["username_error"] = "Meg kell adnod egy felhasználó nevet!";
        $error = true;
    }

    if (empty($email)) {
        $_SESSION["email_error"] = "Meg kell adnod egy email címet!";
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["email_error"] = "Az email formátuma nem megfelelő!";
        $error = true;
    }

    if (empty($password)) {
        $_SESSION["password_error"] = "Meg kell adnod egy jelszót!";
        $error = true;
    } elseif (strlen($password) < 6) {
        $_SESSION["password_error"] = "A jelszónak legalább 6 karakterből kell állnia!";
        $error = true;
    }

    if (empty($confirm_password)) {
        $_SESSION["confirm_password_error"] = "Erősítsd meg a jelszót!";
        $error = true;
    } elseif ($confirm_password != $password) {
        $_SESSION["confirm_password_error"] = "A jelszavak nem egyeznek!";
        $error = true;
    }

    if (!$error) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $conn = getDatabaseConnection();
        $sql = "CALL RegisterUser(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION["success_message"] = "Sikeres regisztráció!";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION["error"] = "Hiba: " . $stmt->error;
            header("Location: registerform.php");
            exit();
        }

        $stmt->close();
        $conn->close();
    } else {
        header("Location: registerform.php");
        exit();
    }
}
?>