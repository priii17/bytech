const formulario = document.querySelector("#registro");

formulario.addEventListener("submit", async (e) => {
  e.preventDefault();

  const usuario = new FormData();
  usuario.append("nombre", formulario.nombre.value);
  usuario.append("apellido", formulario.apellido.value);
  usuario.append("email", formulario.email.value);
  usuario.append("cedula", formulario.cedula.value);
  usuario.append("nacimiento", formulario.nacimiento.value);
  usuario.append("contrasenia", formulario.contrasenia.value);
  usuario.append("usuario", formulario.usuario.value);

  const respuesta = await fetch("../php/registroFuncionario.php", {
    method: "POST",
    body: usuario,
  });

  const mensaje = (await respuesta.text()).trim();

  if (mensaje === "Funcionario guardado correctamente") {
    alert("Funcionario guardado correctamente");
    window.location.href = "../conexion/login.html";
  } else {
    alert("No se guardo funcionario");
  }
});
