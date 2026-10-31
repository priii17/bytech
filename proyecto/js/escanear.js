const resultado = document.getElementById("resultado");
const textoQR = document.getElementById("textoQR");
const enlaceQR = document.getElementById("enlaceQR");
const reader = document.getElementById("reader");
const btnEscanear = document.getElementById("btnEscanear");

//crea el escaner
const scanner = new Html5Qrcode("reader");

// configura del escáner
const configuracion = {
  fps: 15,

  qrbox: (ancho, alto) => {
    const tamaño = Math.floor(Math.min(ancho, alto) * 0.75);

    return {
      width: tamaño,
      height: tamaño,
    };
  },

  aspectRatio: 1, //escaner en forma cuadrada
};

// se ejecuta cuando se reconoce un qr
function qrEscaneado(texto) {
  scanner.stop().then(() => {
    textoQR.textContent = texto;

    resultado.style.display = "block";
    reader.style.display = "none";
    btnEscanear.style.display = "none";

    try {
      const url = new URL(texto);

      if (url.protocol === "http:" || url.protocol === "https:") {
        enlaceQR.href = url.href;
        enlaceQR.style.display = "inline-block";
      } else {
        enlaceQR.style.display = "none";
      }
    } catch {
      enlaceQR.style.display = "none";
    }
  });
}

// inicia el escáner y activa la cámara
function iniciarEscaner() {
  resultado.style.display = "none";
  btnEscanear.style.display = "none";
  reader.style.display = "block";

  scanner
    .start({ facingMode: "environment" }, configuracion, qrEscaneado, (error) => {})
    .catch((error) => {
      console.error(error);

      textoQR.textContent = "No se pudo acceder a la cámara. Verificá los permisos.";

      resultado.style.display = "block";
      reader.style.display = "none";
      btnEscanear.style.display = "inline-block";
    });
}

// boton iniciar el escaner
btnEscanear.onclick = () => {
  iniciarEscaner();
};

// boton escanear nuevamente
document.getElementById("btnOtra").onclick = () => {
  iniciarEscaner();
};
