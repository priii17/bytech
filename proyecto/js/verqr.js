const ventana = document.getElementById("ventanaQr");
const contenedor = document.getElementById("qrContenedor");
const lista = document.getElementById("lista-documentos");

lista.addEventListener("click", (e) => {
  //sube desde lista hasta encontrar btn-ver
  const boton = e.target.closest(".ver");
  if (!boton) return; // si el click no fue en el boton ver no hace nada

  //vacia el contenedor para borrar el QR anterior y que no se acumulen
  contenedor.innerHTML = "";
  //dibuja el QR dentro del contenedor y boton.dataset.url lee la url que guardó el PHP
  new QRCode(contenedor, { text: boton.dataset.url, width: 256, height: 256 });
  //muestra el qr en una ventanita en pantalla
  ventana.showModal();
});
//busca el botón cerrar y añade evento al hacer click
document.getElementById("cerrarQr").addEventListener("click", () => {
  // Cierra la ventanita
  ventana.close();
});
