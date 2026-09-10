document.querySelector("#registro").addEventListener("submit", validar);

function validar(event) {
  event.preventDefault(); //frena el envio del formulario (no ejecuta el php hasta validar dato)
  const email = document.querySelector("#email").value.trim().toLowerCase(); //tolowercase convierte el texto a minusculas
  const cedula = document.querySelector("#cedula").value.trim(); //trim elimina espacios
  const contrasenia = document.querySelector("#contrasenia").value.trim();
  const contrasenia2 = document.querySelector("#contrasenia2").value.trim();
  const nombre = document.querySelector("#nombre").value.trim();
  const apellido = document.querySelector("#apellido").value.trim();
  const nacimiento = document.querySelector("#nacimiento").value.trim();
  const errores = [];

  if (nombre === "") {
    errores.push("El nombre es obligatorio");
  }
  if (apellido === "") {
    errores.push("El apellido es obligatorio");
  }
  if (nacimiento === "") {
    errores.push("La fecha de nacimiento es obligatoria");
  }

  if (cedula === "") {
    errores.push("La cedula es obligatoria");
  }

  function validarCedula(cedula) {}

  if (contrasenia === "" || contrasenia2 === "") {
    errores.push("La contraseña es obligatoria");
  } else if (contrasenia.length < 8 || !/[A-Z]/.test(contrasenia) || !/[a-z]/.test(contrasenia) || !/[0-9]/.test(contrasenia)) {
    //metodo push añade elementos al array
    errores.push("La contraseña debe tener mínimo 8 caracteres, 1 mayúscula, 1 minúscula y 1 número");
  }

  if (contrasenia != contrasenia2) {
    errores.push("Las contraseñas no coinciden");
  }
  const expresion = /^\S+@\S+\.\S+$/;
  if (email === "") {
    errores.push("El email es obligatorio");
  } else if (!expresion.test(email)) {
    //metodo test permite aplicar expresion regular a una variable
    errores.push("El email es incorrecto");
  }
  if (errores.length > 0) {
    //mostrar errores
    errores.forEach((error) => {
      document.querySelector(".errores").innerHTML += `<p class="error">${error}</p>`;
    });
  } else {
    document.querySelector("#registro").submit(); //si no hay errores, envia los datos del fotmulario al php
  }
}
