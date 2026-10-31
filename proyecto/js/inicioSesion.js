//busca formulario por id
const formulario = document.getElementById("form_inicio");

formulario.addEventListener("submit", async (e) => {
  e.preventDefault(); //evita que se recargue la pagina

  //agrega valores de los campo usuario y contraseña
  const datosI = new FormData();
  datosI.append("usuario", formulario.usuario.value);
  datosI.append("contrasenia", formulario.contrasenia.value);

  //envia los datos mediante post
  const respuesta = await fetch("../php/iniciarSesion.php", {
    method: "POST",
    body: datosI,
  });

  //respuesta del servidor
  const objetoJSON = await respuesta.json();

  if (objetoJSON.error) {
    alert(objetoJSON.error);
  } else if (objetoJSON.exito) {
    window.location.href = "../conexion/real_index.html";
  }
});
