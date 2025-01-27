<?php
include "layout/header.php";

// bejelentkezettek ide írányítása, ha létezik a adatbazisban
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit;
}

$email = "";
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  if(empty($email) || empty($password)) {
    $error = "Írd be a Emailt, jelszót!";
  }
  else {
    include "db.php";
    $dbconnection = getDatabaseConnection();

    $statement = $dbconnection->prepare(
      "SELECT id, first_name, last_name, password, created_at FROM users WHERE email = ?"
    );

    $statement->bind_param('s', $email);

    $statement->execute();

    $statement->bind_result($id, $first_name, $last_name, $stored_password, $created_at);

    if($statement->fetch()) {
      if (password_verify($password, $stored_password)) {
        $_SESSION["id"] = $id;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["email"] = $email;
        $_SESSION["created_at"] = $created_at;

        header("location: index.php");
        exit;
      }
    }

    $statement->close();

    $error = "Email vagy jelszó nem jó";
  }
}


?>

<section id="bejelentkezes">
        <!-- Bejelentkezés -->
        <div class="login-section">
          <form class="modalbejbackground-content animate" action="#" method="post">
            <div class="fobejszoveg">
              <label><b>Bejelentkezés</b></label>
              <hr>

              <?php if (!empty($error)) { ?>
                <div class="alert alert-danger alert-dissmissable fade show" role="alert">
                  <strong><?= $error ?></strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              <?php } ?>
            </div>
        
            <div class="bejencontainer">
              <label for="email"><b>Email</b></label>
              <input type="text" placeholder="Írd be az Email címed" name="email" id="email" value="<?= $email ?>">
              
              <label for="password"><b>Jelszó</b></label>
              <input type="password" placeholder="Írd be a jelszavad" name="password">
              
              <span class="logtoreg">Nincs fiókod? <a class="bejenlinktoregiszt" href="regisztracio.html"><b>Regisztrálj</b></a></span>
              <hr>
              <button class="bejengomb" type="submit"><b>Bejelentkezés</b></button>
            </div>
          </form>
        </div>
</section>  

<?php
include "layout/footer.php";
?>