var contenedor = document.getElementById("preguntas");

document.getElementById("btnAgregar").onclick = function () {
  var div = document.createElement("div");
  div.className = "pregunta";
  div.innerHTML = `
    <input class="texto" placeholder="Pregunta (se responde con estrellas 1-5)">
    <button type="button" class="quitar">Quitar</button>`;

  div.querySelector(".quitar").onclick = function () {
    div.remove();
  };

  contenedor.appendChild(div);
};

function leerPreguntas() {
  var lista = [];
  document.querySelectorAll("#preguntas .pregunta").forEach(function (b) {
    lista.push({
      texto: b.querySelector(".texto").value,
      tipo: "estrellas",
      opciones: [],
    });
  });
  return lista;
}

document.getElementById("btnVista").onclick = function () {
  var vista = document.getElementById("vista-previa");
  vista.innerHTML = "";

  var h2 = document.createElement("h2");
  h2.textContent = document.getElementById("titulo").value;
  vista.appendChild(h2);

  var desc = document.createElement("p");
  desc.textContent = document.getElementById("descripcion").value;
  vista.appendChild(desc);

  leerPreguntas().forEach(function (p, i) {
    var pregunta = document.createElement("p");
    pregunta.textContent = i + 1 + ". " + p.texto;
    vista.appendChild(pregunta);

    var estrellas = document.createElement("div");
    estrellas.style.display = "flex";
    estrellas.style.gap = "6px";

    for (var n = 1; n <= 5; n++) {
      var s = document.createElement("span");
      s.textContent = "★";
      s.style.fontSize = "32px";
      s.style.color = "#ccc";
      estrellas.appendChild(s);
    }
    vista.appendChild(estrellas);
  });

  var cerrar = document.createElement("button");
  cerrar.type = "button";
  cerrar.id = "btnCerrar";
  cerrar.textContent = "Cerrar vista previa";
  cerrar.onclick = function () {
    vista.innerHTML = "";
  };
  vista.appendChild(document.createElement("br"));
  vista.appendChild(cerrar);
};

document.getElementById("btnGuardar").onclick = function () {
  var preguntas = leerPreguntas().filter(function (p) {
    return p.texto.trim() !== "";
  });

  if (preguntas.length === 0) {
    return alert("Agregá al menos una pregunta.");
  }

  fetch("../php/crear_encuesta.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      titulo: document.getElementById("titulo").value,
      descripcion: document.getElementById("descripcion").value,
      preguntas: preguntas,
    }),
  })
    .then(function (r) {
      return r.json();
    })
    .then(function (resultado) {
      alert(resultado.mensaje);
      if (resultado.ok) {
        window.location.href = "../encuestas/encuestas.html";
      }
    })
    .catch(function (e) {
      console.error(e);
      alert("No se pudo conectar con el servidor.");
    });
};
