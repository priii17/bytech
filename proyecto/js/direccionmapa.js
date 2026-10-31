const mapa = L.map("visualizar").setView([-32.5, -56], 7); // Crea el mapa dentro del elemento con id="visualizar"
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  // Agrega la capa de imágenes (diseño) de OpenStreetMap
  attribution: "© OpenStreetMap",
}).addTo(mapa);

const apiKey = "46f50803008b4df8b0bf8d87429dda7b";
// Guarda lo que hay dibujado en el mapa para poder borrarlo y ñuego cambiarlo
// cuando el funcionario haga una nueva busqueda
let marcadorOrigen = null;

let marcadorDestino = null;

let rutaDibujada = null;

// Convierte la dirrecion en coordenadas (geocodificación).

async function buscar(idDepto, idDir, idLat, idLng) {
  //recibe los selectores de los campos que debe usar para convertir
  //   idDepto es imput de departamento
  //   idDir input dedirección
  //   idLat / idLng se guarda latitud y longitud
  const texto = `${document.querySelector(idDir).value}, ${document.querySelector(idDepto).value}, Uruguay`;

  // Arma la URL de la API de Geoapify con los parámetros:

  const url =
    "https://api.geoapify.com/v1/geocode/search?" +
    `text=${encodeURIComponent(texto)}` +
    "&filter=countrycode:uy" + //limita a uruguay
    "&lang=es&limit=1&format=json" +
    `&apiKey=${apiKey}`;

  // Hace la consulta y convierte la respuesta a objeto JavaScript
  const respuesta = await fetch(url);
  const dato = await respuesta.json();
  // Toma el primer resultado, si no hubo queda undefined
  const resultado = dato.results[0];

  // usa los resultados, luego guarda las coordenadas en los inputs del form
  if (resultado) {
    document.querySelector(idLat).value = resultado.lat;
    document.querySelector(idLng).value = resultado.lon;

    return resultado;
  } else {
    alert("No se encontró la dirección");
    return null;
  }
}

document.querySelector("#buscar_origen").addEventListener("click", async () => {
  // Busca la dirección de origen y guarda las coordenadas
  const r = await buscar(
    "#departamento_origen",
    "#descripcionorigen",
    "#lat_origen",
    "#lng_origen",
  );
  if (r) {
    // Si ya había un marcador de origen, lo borra
    if (marcadorOrigen) mapa.removeLayer(marcadorOrigen);
    marcadorOrigen = L.marker([r.lat, r.lon]).addTo(mapa).bindPopup("Origen");
    // Acerca al mapa el punto marcado
    mapa.setView([r.lat, r.lon], 15);
  }
});
// hace lo mismo que origen pero para destino
document

  .querySelector("#buscar_destino")
  .addEventListener("click", async () => {
    const r = await buscar(
      "#departamento_destino",
      "#Descripciondestino",
      "#lat_destino",
      "#lng_destino",
    );
    if (r) {
      if (marcadorDestino) mapa.removeLayer(marcadorDestino);
      marcadorDestino = L.marker([r.lat, r.lon])
        .addTo(mapa)
        .bindPopup("Destino");
      mapa.setView([r.lat, r.lon], 15);
    }
  });

// Pide a Geoapify el camino de origen a destino y lo traza(dibuja)
async function trazarRuta() {
  try {
    const origen = [
      // Lee las coordenadas guardadas en los inmput
      document.querySelector("#lat_origen").value,
      document.querySelector("#lng_origen").value,
    ];
    const destino = [
      document.querySelector("#lat_destino").value,
      document.querySelector("#lng_destino").value,
    ];
    console.log("Origen:", origen, "Destino:", destino);

    // Si falta alguna coordenad, da un aviso y corta su ejecucion
    if (!origen[0] || !destino[0]) {
      alert("Primero buscá el origen y el destino");
      return;
    }

    // Arma la url de api en rutas
    //   waypoints marca los puntos del recorrido en los dos formatos lat y lon
    const urlRuta =
      "https://api.geoapify.com/v1/routing?" +
      `waypoints=${origen[0]},${origen[1]}|${destino[0]},${destino[1]}` +
      "&mode=drive&units=metric&lang=es" +
      `&apiKey=${apiKey}`;

    // Hace la consulta y convierte la respuesta a objeto
    const resp = await fetch(urlRuta);

    const routeo = await resp.json();
    console.log("Respuesta:", routeo);

    // Si la API no devolvió ninguna ruta muestra el error
    if (!routeo.features || !routeo.features.length) {
      alert("Geoapify no devolvió ruta: " + JSON.stringify(routeo));
      return;
    }

    // La geometría puede ser una línea o varias (MultiLineString);
    const geom = routeo.features[0].geometry;
    const lineas =
      geom.type === "MultiLineString" ? geom.coordinates : [geom.coordinates];
    const dibujo = lineas.flat().map(([lon, lat]) => [lat, lon]);

    // Junta todos los puntos y los pasa de [lon, lat] (formato Geoapify)
    // a [lat, lon] (formato Leaflet)
    if (rutaDibujada) mapa.removeLayer(rutaDibujada);

    rutaDibujada = L.polyline(dibujo, { color: "blue", weight: 5 }).addTo(mapa);

    // Ajusta el zoom para que se vea la ruta completa
    mapa.fitBounds(rutaDibujada.getBounds());
  } catch (e) {
    console.error(e);
    alert("Error: " + e.message);
  }
}
// Al hacer clic en "Trazar ruta", ejecuta la función anterior
document.querySelector("#trazar_ruta").addEventListener("click", trazarRuta);
