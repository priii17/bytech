const iconos = document.querySelectorAll(".i-contrasenia i");

iconos.forEach((icono) => {
  icono.addEventListener("click", () => {
    //busca hacia arriba entre los elementos padre
    const campo = icono.closest(".campo");
    const input = campo.querySelector(".input-contrasenia");

    if (input.type === "password") {
      input.type = "text";
      icono.classList.remove("fa-eye");
      icono.classList.add("fa-eye-slash");
    } else {
      input.type = "password";
      icono.classList.remove("fa-eye-slash");
      icono.classList.add("fa-eye");
    }

    icono.classList.toggle("activo");
  });
});
