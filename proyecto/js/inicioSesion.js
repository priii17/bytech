const formulario = document.getElementById("#iniciarSesion");    

formulario.addEventListener('submit', async (e) =>{
    e.preventDefault()

    const datosI=new FormData();
    datosI.append('usuario',formulario.usuario.value);
    datosI.append('contrasenia',formulario.contrasenia.value);

    const respuesta = await fetch('../php/iniciarSesion.php',{
        method: 'POST',
        body: datosI
    })

    const objetoJSON = await respuesta.json();

    if(objetoJSON.error){
      alert(objetoJSON.error);

    }else if(objetoJSON.exito){
        window.location.href='../conexion/index.html';
    }
})
