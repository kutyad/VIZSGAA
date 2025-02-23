<section id="bejelentkezes">
    <div class="login-section">
        <div class="modal fade" id="loginModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <form id="loginForm" class="modalbejbackground-content animate">
                            <div class="fobejszoveg">
                                <label><h2>Bejelentkezés</h2></label>
                            </div>
                            <div class="bejencontainer">
                                <label for="email"><b>Email</b></label>
                                <input type="text" class="border-0 border-bottom" name="email" id="email" required>
                                
                                <label for="password"><b>Jelszó</b></label>
                                <input type="password" class="border-0 border-bottom" name="password" id="password" required>
                                
                                <span class="text-danger" id="loginError"></span>
                                
                                <span class="logtoreg">Nincs fiókod? <a class="bejenlinktoregiszt" href="registerform.php"><b>Regisztrálj</b></a></span>
                                <button class="bejengomb" type="submit"><b>Bejelentkezés</b></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
    };

    fetch("api.php?endpoint=login", {
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
            document.getElementById("loginError").textContent = data.message;
        }
    })
    .catch((error) => console.error("Error:", error));
});
</script>