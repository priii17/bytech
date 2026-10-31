// 2. Guardar en variables los elementos del HTML que vamos a modificar,
// así no repetimos getElementById cada vez.
const nombre = document.getElementById("nombre");
const apellido = document.getElementById("apellido");
const cedula = document.getElementById("cedula");
const email = document.getElementById("email");
const avatar = document.getElementById("avatar");
const Error = document.getElementById("error");

// 3. Pedirle los datos al PHP (sin recargar la página).
fetch("../php/perfil.php?")
  // 4. Cuando llega la respuesta, convertirla de texto JSON a objeto JavaScript.
  .then((respuesta) => respuesta.json())

  // 5. Con el objeto ya convertido, mostrar los datos.
  .then((datos) => {
    // Si el PHP mandó {"error": "..."}, mostramos el mensaje y cortamos acá.
    if (datos.error) {
      nombre.textContent = "";
      Error.textContent = datos.error;
      return;
    }

    // textContent pone el valor como texto plano (más seguro que innerHTML).
    apellido.textContent = datos.apellido;
    nombre.textContent = datos.nombre;
    cedula.textContent = datos.cedula;
    email.textContent = datos.email;

    // Primera letra del nombre en mayúscula para el avatar.
    avatar.textContent = datos.nombre.charAt(0).toUpperCase();
  })

  // 6. Si falla la red o el PHP no devuelve JSON válido, se ejecuta esto.
  .catch(() => {
    console.log(error);
    Error.textContent = "Error de conexión";
  });
