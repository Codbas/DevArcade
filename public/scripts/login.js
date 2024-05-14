"use strict"
document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "../includes/validateLogin.php", true);

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            let loginMessage = document.getElementById("login-message");

            if(xhr.responseText.indexOf("success") !== -1){
                loginMessage.style.color = "green";
                loginMessage.innerHTML = "Login successful. You will be redirected in 3 seconds...";

                // TODO: save session

                setTimeout(function() {
                    window.location.href = "Home.php";
                }, 3000);
            }
            else {
                loginMessage.innerHTML = xhr.responseText;
            }
        } else {
            console.error("Request failed with status:", xhr.status);
        }
    };

    xhr.onerror = function() {
        console.error("Request failed");
    };

    xhr.send(formData);
});