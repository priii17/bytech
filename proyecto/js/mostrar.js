//busca elemento i en la clase i-contraseña
const icono = document.querySelector(".i-contrasenia i");

//agrega evento al hacer click
  icono.addEventListener("click", () => {
    //busca hacia arriba entre los elementos padre
    const campo = icono.closest(".campo");
    const input = campo.querySelector(".input-contrasenia");

    //convierte a texto
    if (input.type === "password") {
      input.type = "text";
      icono.classList.remove("fa-eye");
      icono.classList.add("fa-eye-slash");
    //vuelve a tipo contraseña
    } else {
      input.type = "password";
      icono.classList.remove("fa-eye-slash");
      icono.classList.add("fa-eye");
    }

    //agrega clase activo para aplicar css(cambia color)
    icono.classList.toggle("activo");
  });

