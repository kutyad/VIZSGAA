<?php
include "layout/header.php";

// bejelentkezettek ide írányítása, ha létezik a adatbazisban
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit;
}


$first_name = "";
$last_name = "";
$email = "";

$first_name_error = "";
$last_name_error = "";
$email_error = "";
$password_error = "";
$confirm_password_error = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    //elso igazolasa
    if (empty($first_name)) {
        $first_name_error = "meg kell adnod a keresztnevedet";
        $error = true;
    }

    //masodik igazolasa
    if (empty($last_name)) {
        $last_name_error = "meg kell adnod a vezetéknevedet";
        $error = true;
    }

    //email igazolasa
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email formátum nem megfelelő";
        $error = true;
    }

    include "tools/db.php";
    $dbconnection = getDatabaseConnection();

    $statement = $dbconnection->prepare("SELECT id FROM users WHERE email = ?");

    $statement->bind_param("s",$email);

    $statement->execute();

    $statement->store_result();
    if ($statement->num_rows > 0) {
        $email_error = "Ez az Email már használt";
        $error = true;
    }

    $statement->close();



    //jelszavak
    if (strlen($password) < 6) {
        $password_error = "a jelszónak legalább 6 betüből kell állnia";
        $error = true;
    }

    if ($confirm_password != $password) {
        $password_error = "a jelszavak nem egyeznek";
        $error = true;
    }


    if(!$error) {
        // Felhasználó létrehozása 
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbconnection->prepare(
            "INSERT INTO users (first_name, last_name, email, password, created_at) " . "VALUES (?, ?, ?, ?, ?)"
        );

        // változók beillesztése prepared-be parameterként  ?=beírt elem, s=6 string típusú elem
        $statement->bind_param('sssss', $first_name, $last_name, $email, $password, $created_at);

        //lefutatas eredeti
        //$statement->execute();

        //$insert_id = $statement->$insert_id;
        //$statement->close();

        // Lefuttatás
        if ($statement->execute()) {
            $insert_id = $dbconnection->insert_id; // Az új beszúrt ID lekérése
        } else {
            // Ha hiba történik, kezelheted itt
            die("Hiba történt: " . $statement->error);
        }

        $statement->close();

        // session adatok elmentese 
        $_SESSION["id"] = $insert_id;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["email"] = $email;
        $_SESSION["created_at"] = $created_at;
        
        header("location: index.php");
        exit;
    }
}
?>

<section>
      <div class="login-section">
        <form class="modalbejbackground-content animate" action="#" method="post">
          <div class="fobejszoveg">
            <label for="email"><b>Regisztráció</b></label>
            <hr>
          </div>
      
          <div class="bejencontainer">
            <div>
                <label for="name"><b>Keresztnév</b></label>
                <input type="text" placeholder="Írja be a keresztnevét" name="first_name" value="<?= $first_name ?>" >
                <span class="text-danger"><?= $first_name_error ?></span>
            </div>
            <div>
                <label for="name"><b>Vezetéknév</b></label>
                <input type="text" placeholder="Írja be a vezetéknevét" name="last_name" value="<?= $last_name ?>" >
                <span class="text-danger"><?= $last_name_error ?></span>
            </div>
            <div>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Írd be az email címed" name="email" id="email" value="<?= $email ?>" >
                <span class="text-danger"><?= $email_error ?></span>
            </div>
            <div>    
                <label for="psw"><b>Jelszó</b></label>
                <input type="password" placeholder="Írd be a jelszavad" name="password" >
                <span class="text-danger"><?= $password_error ?></span>
            </div>
            <div>    
                <label for="psw-repeat"><b>Jelszó mégegyszer</b></label>
                <input type="password" placeholder="Jelszó mégegyszer" name="confirm_password" >
                <span class="text-danger"><?= $confirm_password_error ?></span>
            </div>
            <div>    
                <span class="logtoreg">Van fiókod? <a class="bejenlinktoregiszt" href="Bejelentkezes.php"><b>Bejelentkezés</b></a></span>
                <hr>
                <button class="regisztgomb" type="submit"><b>Regisztráció</b></button>
            </div>
          </div>
        </form>
      </div>
</section>  



<?php
include "layout/footer.php";
?>