<?php
include "header.php";
?>

    <section id="Regisztracio">
      <div class="login-section">
        <form class="modalbejbackground-content animate" action="#" method="post">
          <div class="fobejszoveg">
            <label><h2>Regisztráció</h2></label>
          </div>
      
          <div class="bejencontainer">
            <label for="name"><b>Felhasználónév</b></label>
            <input type="text" class="border-0 border-bottom"  name="username" id="name" required>
          
            <label for="email"><b>Email</b></label>
            <input type="text" class="border-0 border-bottom"  name="email" id="email" required>
            
            <label for="psw"><b>Jelszó</b></label>
            <input type="password" class="border-0 border-bottom"  name="psw" required>
            
            <label for="psw-repeat"><b>Jelszó mégegyszer</b></label>
            <input type="password" class="border-0 border-bottom"  name="psw-repeat" id="psw-repeat" required>
            
            <button class="bejengomb" type="submit"><b>Regisztráció</b></button>
          </div>
        </form>
      </div>
    </section>  

<?php
include "footer.php";
?>