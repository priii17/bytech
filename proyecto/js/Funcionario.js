
const elemento = document.getElementById('Trasladar');

const selectormuestra = document.getElementById('foldmuestra');

const selectorequipamiento = document.getElementById('foldequipamiento');

const selectorinsumo = document.getElementById('foldinsumos');





//* espera a que se eliga una opcion distinta,luego ejecuta*//
elemento.addEventListener( 'change', ( ) => {

let opcion = elemento.value;

selectormuestra.style.display = 'none';

selectorequipamiento.style.display = 'none'; 

selectorinsumo.style.display = 'none';

switch(opcion){

case "muestra":
    selectormuestra.style.display = 'flex'
   foldmuestra.innerHTML  =`
  
     <input type="text" id="nombremuestra" placeholder="nombre"> </input>
 
  <input type="text" id="descripcion" placeholder="Descripción"> </input>
`;
  
    break;
  


  case "equipamiento":
    selectorequipamiento.style.display = 'flex';
    foldequipamiento.innerHTML   =`
<input type='text' id='n_serie' placeholder="Ingrese n_serie">
 
  <input type="text" id="descripcionquipamiento" placeholder="Descripción"> 
    `;
   
    break;

case "insumos":
    selectorinsumo.style.display = 'flex';
    foldinsumos.innerHTML = `
    <input type="text" id="nombreinsumo" placeholder="Ingrese nombre del insumo">

<input type="text"  id="descripcioninsumo" placeholder="Descripción">

        `;
         
    break;

         
    
}

});





