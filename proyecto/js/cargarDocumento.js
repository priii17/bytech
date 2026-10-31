const nombre = document.getElementById("nombre");
const documento = document.getElementById("documento");
const btn = document.getElementById("btn");
const mens = document.getElementById("mensaje");

btn.addEventListener("click", async (e) => {
  // cancela la acción por defecto que hace el navegador al ocurrir un evento
  e.preventDefault();

  // Crea un objeto FormData para enviar datos al servidor
  const doc = new FormData();
  doc.append("nombre", nombre.value);
  //agrega el primer archivo sleccionado (posicion 0)
  doc.append("documento", documento.files[0]);

  //envia los datos al archivo php
  let respuesta = await fetch("../php/cargarDocumento.php", {
    method: "POST",
    body: doc,
  });

  let mensaje = (await respuesta.text()).trim();
  console.log("Respuesta del PHP:", mensaje);

  //revisar que el texto comienze con http y mostrar ok
  if (mensaje.startsWith("https")) {
    mens.textContent = "Archivo subido correctamente";
    mens.style.color = "green";
  } else {
    mens.textContent = "Ocurrió un error al subir el archivo.";
    mens.style.color = "red";
  }
});
