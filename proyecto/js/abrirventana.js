document.addEventListener("DOMContentLoaded", () => {
  const abrir = document.getElementById("subir");

  if (abrir) {
    abrir.addEventListener("click", () => {
      window.location.href = "../documento/subirdoc.html";
    });
  }
});
