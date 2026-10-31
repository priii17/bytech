console.log("JavaScript de encuestas cargado");

const contenido = document.getElementById("contenido");

async function cargarLista() {
  const res = await fetch("../php/listar_encuestas.php");
  const encuestas = await res.json();

  contenido.innerHTML = encuestas.length
    ? ""
    : "<p>No hay encuestas disponibles.</p>";

  encuestas.forEach((e) => {
    const div = document.createElement("div");
    div.className = "item";
    div.textContent = e.titulo ?? "Encuesta " + e.id;
    div.onclick = () => abrirEncuesta(e);
    contenido.appendChild(div);
  });
}

function abrirEncuesta(encuesta) {
  const valores = {};

  contenido.innerHTML = "";

  const h3 = document.createElement("h3");
  h3.textContent = encuesta.titulo ?? "Encuesta " + encuesta.id;
  contenido.appendChild(h3);

  const descripcion = document.createElement("p");
  descripcion.textContent = encuesta.descripcion ?? "";
  contenido.appendChild(descripcion);

  encuesta.preguntas.forEach((p, pos) => {
    const texto = typeof p === "string" ? p : (p.texto ?? p.pregunta);

    const div = document.createElement("div");
    div.className = "pregunta";
    div.style.margin = "16px 0";

    const parrafo = document.createElement("p");
    parrafo.textContent = texto;
    div.appendChild(parrafo);

    const cont = document.createElement("div");
    cont.className = "estrellas";
    cont.style.display = "flex";
    cont.style.gap = "6px";

    const pintar = (n) =>
      cont.querySelectorAll(".estrella").forEach((e) => {
        e.style.color = Number(e.dataset.valor) <= n ? "gold" : "#ccc";
      });

    for (let i = 1; i <= 5; i++) {
      const estrella = document.createElement("button");
      estrella.type = "button";
      estrella.textContent = "★";
      estrella.className = "estrella";
      estrella.dataset.valor = i;

      estrella.style.background = "none";
      estrella.style.border = "none";
      estrella.style.padding = "0";
      estrella.style.margin = "0";
      estrella.style.fontSize = "32px";
      estrella.style.color = "#ccc";
      estrella.style.cursor = "pointer";

      estrella.onmouseover = () => pintar(i);
      estrella.onclick = () => {
        valores[pos] = i;
        pintar(i);
      };

      cont.appendChild(estrella);
    }

    cont.onmouseleave = () => pintar(valores[pos] ?? 0);

    div.appendChild(cont);
    contenido.appendChild(div);
  });

  const boton = document.createElement("button");
  boton.textContent = "Enviar respuestas";
  boton.type = "button";
  boton.className = "enviar-encuesta";

  boton.onclick = async () => {
    if (Object.keys(valores).length !== encuesta.preguntas.length) {
      alert("Debes responder todas las preguntas.");
      return;
    }

    const datos = new FormData();
    datos.append("id_encuesta", encuesta.id);
    datos.append("respuesta", JSON.stringify(valores));

    try {
      const res = await fetch("../php/guardar_respuesta.php", {
        method: "POST",
        body: datos,
      });

      const texto = await res.text();
      console.log("Respuesta del servidor:", texto);

      if (!res.ok || texto.trim() !== "ok") {
        return alert("No se pudo guardar: " + texto);
      }

      contenido.innerHTML = `
        <p>¡Gracias por responder!</p>
        <a class="btn" href="../conexion/encuestas_usuario.html">Volver</a>`;

      document.getElementById("otra").onclick = cargarLista;
    } catch (error) {
      console.error("Error:", error);
      alert("No se pudo conectar con el servidor.");
    }
  };

  contenido.appendChild(boton);
}

cargarLista();
