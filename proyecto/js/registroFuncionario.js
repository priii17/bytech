const formulario = document.querySelector('#registro');

formulario.addEventListener('submit', async (e) => {
    e.preventDefault();

    const usuario = new FormData();
    usuario.append('nombre', formulario.nombre.value);
    usuario.append('apellido', formulario.apellido.value);
    usuario.append('email', formulario.email.value);
    usuario.append('cedula', formulario.cedula.value);
    usuario.append('nacimiento', formulario.nacimiento.value);
    usuario.append('contrasenia', formulario.contrasenia.value);
    usuario.append('usuario', formulario.usuario.value);

    const respuesta = await fetch('../php/registroFuncionario.php', {
        method: 'POST',
        body: usuario
    })

    const mensaje = await respuesta.text();
    console.log('Error:' , mensaje);

    if(mensaje === 'ok'){
        alert('Funcionario Guardado Correctamente');
    }else{
        alert('No se guardo funcionario');
    }
     
})