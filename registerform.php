<?php
include "header.php";
?>
<section id="Regisztracio">
    <div class="login-section">
        <form id="registerForm" class="modalbejbackground-content animate">
            <div class="fobejszoveg">
                <label><h2>Regisztráció</h2></label>
            </div>
        
            <div class="bejencontainer">
                <label for="name"><b>Felhasználónév</b></label>
                <input type="text" class="border-0 border-bottom" name="username" id="username" required>
                <br><span class="text-danger" id="usernameError"></span>
            
                <label for="email"><b>Email</b></label>
                <input type="text" class="border-0 border-bottom" name="email" id="email" required>
                <br><span class="text-danger" id="emailError"></span>
                
                <label for="psw"><b>Jelszó</b></label>
                <input type="password" class="border-0 border-bottom" name="password" id="password" required>
                <br><span class="text-danger" id="passwordError"></span>
                
                <label for="psw-repeat"><b>Jelszó mégegyszer</b></label>
                <input type="password" class="border-0 border-bottom" name="confirm_password" id="confirm_password" required>
                <br><span class="text-danger" id="confirmPasswordError"></span> 
                
                <button class="bejengomb" type="submit"><b>Regisztráció</b></button>
            </div>
        </form>
    </div>
</section>

<script>
document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = {
        username: document.getElementById("username").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
        confirm_password: document.getElementById("confirm_password").value,
    };

    fetch("api.php?endpoint=register", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            window.location.href = "index.php";
        } else {
            if (data.errors) {
                document.getElementById("usernameError").textContent = data.errors.username || "";
                document.getElementById("emailError").textContent = data.errors.email || "";
                document.getElementById("passwordError").textContent = data.errors.password || "";
                document.getElementById("confirmPasswordError").textContent = data.errors.confirm_password || "";
            } else {
                alert(data.message);
            }
        }
    })
    .catch((error) => console.error("Error:", error));
});
</script>

<?php
include "loginform.php";

include "footer.php"
?>