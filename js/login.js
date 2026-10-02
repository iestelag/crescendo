const passwordInput = document.querySelector("#password");
const togglePassword = document.querySelector(".toggle-password");

togglePassword.addEventListener("click", () => {

  if (passwordInput.type === "password") {

    // Mostrar contraseña
    passwordInput.type = "text";
    togglePassword.textContent = "visibility";

  } else {

    // Ocultar contraseña
    passwordInput.type = "password";
    togglePassword.textContent = "visibility_off";

  }

});