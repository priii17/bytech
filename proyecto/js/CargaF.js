async function cargarSelect(idSelect, tipo) {
  const select = document.getElementById(idSelect);

  try {
    const respuesta = await fetch(`../php/listar.php?tipo=${tipo}`);
    const funcionario = await respuesta.json();

    if (!respuesta.ok)
      throw new Error(funcionarios.error || `HTTP ${respuesta.status}`);

    funcionario.forEach((f) => {
      const opcion = document.createElement("option");
      opcion.value = f.id;
      opcion.textContent = f.nombre;
      select.appendChild(opcion);
    });
  } catch (error) {
    console.error(error);
    alert(`No se pudieron cargar los ${tipo}s: ${error.message}`);
  }
}

cargarSelect("id_conductor", "conductor");
cargarSelect("id_acompaniante", "acompaniante");
