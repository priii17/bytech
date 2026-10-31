const elemento = document.getElementById("Trasladar");

const campos = {
  equipamiento: {
    div: document.getElementById("campo-equipamiento"),
    select: document.getElementById("id_equipamiento"),
    url: "../php/listar_equipamiento.php",
  },
  insumos: {
    div: document.getElementById("campo-insumos"),
    select: document.getElementById("id_insumo"),
    url: "../php/listar_insumo.php",
  },
};

async function cargarOpciones(campo) {
  try {
    const respuesta = await fetch(campo.url);
    const datos = await respuesta.json();

    campo.select.innerHTML = '<option value="">-- Elegir --</option>';

    datos.forEach((item) => {
      const valores = Object.values(item);
      const opcion = document.createElement("option");
      opcion.value = item.id ?? valores[0];
      opcion.textContent = item.texto ?? valores.join(" - ");
      campo.select.appendChild(opcion);
    });
  } catch (error) {
    console.error("Error cargando", campo.url, error);
  }
}

elemento.addEventListener("change", () => {
  const opcion = elemento.value;

  for (const clave in campos) {
    if (!campos[clave].div) console.error("Falta el div de:", clave);
    if (!campos[clave].select) console.error("Falta el select de:", clave);
  }

  // Muestra solo el elegido y carga sus registros
  if (campos[opcion]) {
    campos[opcion].div.style.display = "block";
    cargarOpciones(campos[opcion]);
  }
});
