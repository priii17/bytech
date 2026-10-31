async function cargarSelect(idSelect) {
  const select = document.getElementById(idSelect);
  if (!select) {
    console.error(`No existe el elemento #${idSelect}`);
    return;
  }

  try {
    const respuesta = await fetch("../php/listar_ambulancia.php");
    const datos = await respuesta.json();

    if (!respuesta.ok) {
      throw new Error(datos.error || `HTTP ${respuesta.status}`);
    }

    datos.forEach((a) => {
      const opcion = document.createElement("option");
      opcion.value = a.id;
      opcion.textContent = `${a.matricula} - ${a.modelo}`;
      select.appendChild(opcion);
    });
  } catch (error) {
    console.error(error);
    alert(`No se pudieron cargar las ambulancias: ${error.message}`);
  }
}

cargarSelect("id_ambulancia");
