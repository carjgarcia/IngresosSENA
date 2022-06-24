//Select de sede
var sede = document.getElementById("sede");
sede.addEventListener("change", function () {
  var selectedOption = this.options[sede.selectedIndex];
  var opcion=selectedOption.value;
  if (opcion!="Sede TIC" && opcion!="ninguno") {
    document.querySelector('#motivoView').style.display="block";
  }else{
    document.querySelector('#motivoView').style.display="none";
  }
});

//Select de articulo
var dispo = document.getElementById("dispositivos");
dispo.addEventListener("change", function () {
  var selectedOption = this.options[dispo.selectedIndex];
  var opcion=selectedOption.value;
  if (opcion=="otro") {
    document.querySelector('#otroDispositivo').style.display="block";
  }else{
    document.querySelector('#otroDispositivo').style.display="none";
  }

  if (opcion!="ninguno") {
    document.querySelector('#dispositivoDiv').style.display="block";
  }else{
    document.querySelector('#dispositivoDiv').style.display="none";
  }
});

$(document).on('click','#btnQuitarDis',function(){
  let element = $(this)[0].parentElement.parentElement;
  let id = $(element).attr('pos');
  $.ajax({
    url:'../includes/eliminarRegistro.php',
    type: 'POST',
    data: {id},
    success: function(resp){
      console.log(resp);
    }
  })
})

/*FUNCION PARA CAPTURAR Y MOSTRAR LOS DATOS DEL FORMULARIO EN LA CONSOLA*/
$('#imprimir').on('click',function(event){
  event.preventDefault();
  const id = document.getElementById('idDocumento').value;
  const nombre = document.getElementById('nombres').value;
  const correo = document.getElementById('correo').value;
  const sede = document.getElementById('sede').value;
  const vehiculo = document.querySelector('input[name="vehiculo"]:checked').value;


  let articulos = [];
  let tabla = document.getElementById('tablaDispositivos');
  let filas = tabla.getElementsByTagName('tbody')[0];
  let numFilas = filas.children.length;

  for (let i = 1; i <= numFilas; i++) {
    let fila = tabla.rows[i].getElementsByTagName('td');
    let dispositivo = [];
    for (const celda of fila) {
      dispositivo.push(celda.innerHTML);
    }
    articulos.push(dispositivo);
  }

  const fecha = document.getElementById('fecha').value;
  const hora = document.getElementById('hora').value;

  console.log(id,nombre,correo,sede,vehiculo,articulos,fecha,hora);
});

let dispositivos= [
  // {
  //   "Producto":"Celular",
  //   "Marca":"Nokia",
  //   "Serial":"123",
  //   "Placa":"ABC",
  //   "Propietario":"SENA",
  //   "Cantidad":"1"
  // },
  // {
  //   "Producto":"Tablet",
  //   "Marca":"Lg",
  //   "Serial":"456",
  //   "Placa":"DEF",
  //   "Propietario":"SENA",
  //   "Cantidad":"1"
  // }
],posicionSeleccionada=null;

function imprimirRegistros(valores) {
  let templatehtml=``; 
  let i=0;
  valores.forEach(element => {
    templatehtml+=`
      <tr>
            <td><i onclick="seleccionarRegistro(${i})">${element.Producto}</i></td>
            <td>${element.Marca}</td>
            <td>${element.Serial}</td>
            <td>${element.Placa}</td>
            <td>${element.Propietario}</td>
            <td>${element.Cantidad}</td>  
            <td><button style="cursor: pointer" onclick="eliminarRegistro(${i})">Eliminar</button></td>  
      </tr>
    `;
    i++;
  });
  $("#cuerpotabla").html(templatehtml);
}

imprimirRegistros(dispositivos);


//CREAR
$('#agregar').on('click',function(event){
  event.preventDefault();
  let dispo=$('#dispositivos').val();
  let marca=$('#marca').val();
  let serial=$('#serial').val();
  let placa=$('#placa').val();
  let propietario=$('#propietario').val();
  let cantidad=$('#cantidad').val();

  dispositivos[dispositivos.length]={
    "Producto":dispo,
    "Marca":marca,
    "Serial":serial,
    "Placa":placa,
    "Propietario":propietario,
    "Cantidad":cantidad
  };

  imprimirRegistros(dispositivos);
  limpiarcampos();

});

//EDITAR
$('#editar').on('click',function(event){
  if (posicionSeleccionada!=null) {
    event.preventDefault();
    let dispo=$('#dispositivos').val();
    let marca=$('#marca').val();
    let serial=$('#serial').val();
    let placa=$('#placa').val();
    let propietario=$('#propietario').val();
    let cantidad=$('#cantidad').val();
    
    dispositivos[posicionSeleccionada]={
      "Producto":dispo,
      "Marca":marca,
      "Serial":serial,
      "Placa":placa,
      "Propietario":propietario,
      "Cantidad":cantidad
    };

    imprimirRegistros(dispositivos);
    limpiarcampos();
  }
});

//ELIMINAR
function eliminarRegistro(posicion) {
  dispositivos.splice(posicion,1);
  imprimirRegistros(dispositivos);
}

//SELECCIONAR REGISTRO
function seleccionarRegistro(posicion) {
  const registroSeleccionado=dispositivos[posicion];
  posicionSeleccionada=posicion;
  $('#dispositivos').val(registroSeleccionado.Producto);
  $('#marca').val(registroSeleccionado.Marca);
  $('#serial').val(registroSeleccionado.Serial);
  $('#placa').val(registroSeleccionado.Placa);
  $('#propietario').val(registroSeleccionado.Propietario);
  $('#cantidad').val(registroSeleccionado.Cantidad);
}

//LIMPIAR CAMPOS (BOTÓN LIMPIAR)
$('#limpiar').on('click',function(event){
  event.preventDefault();
  $("#dispositivos").val(null);
  $('#marca').val(null);
  $('#serial').val(null);
  $('#placa').val(null);
  $('#propietario').val(null);
  $('#cantidad').val(null);
  posicionSeleccionada=null;
});

//LIMPIAR CAMPOS (FUNCIÓN)
function limpiarcampos() {
  $("#dispositivos").val(null);
  $('#marca').val(null);
  $('#serial').val(null);
  $('#placa').val(null);
  $('#propietario').val(null);
  $('#cantidad').val(null);
  posicionSeleccionada=null;
}


//SISTEMA DE ALERTAS
/* const boton = document.querySelector('#formulario');
boton.addEventListener('submit', ingresar);

function ingresar(e){
  e.preventDefault();
  const documento = document.querySelector('#idDocumento').value;
  const nombresss = document.querySelector('#nombresss').value;
  const correo = document.querySelector('#correo').value;
  const sede = document.querySelector('#sede').value;
  const motivo = document.querySelector('#motivo').value;

  const dispo = document.querySelector('#dispositivos').value;
  const marca = document.querySelector('#marca').value;
  const serial = document.querySelector('#serial').value;
  const placa = document.querySelector('#placa').value;
  const propietario = document.querySelector('#propietario').value;
  const cantidad = document.querySelector('#cantidad').value;

  const fecha = document.querySelector('#fecha').value;
  const hora = document.querySelector('#hora').value;
  
  if(nombresss === ""){
    Swal.fire({
      title: 'Error',
      text: 'Campo es obligatorio',
      icon: 'error',
      confirmButtonText: 'Confirmar'
    });
  }else{
    Swal.fire({
      title: `${valor}`,
      text: 'Bienvenido al consultorio',
      icon: 'success',
      confirmButtonText: 'Confirmar'
    });
  }
} */

const boton = document.getElementById('ingresar');
boton.addEventListener('click', aplicar);

function aplicar(e){
  e.preventDefault();
  // let documento = document.querySelector('#idDocumento').value;
  let documento = document.querySelector('#idDocumento').value;
  let nombres = document.querySelector('#nombres').value;
  let correo = document.querySelector('#correo').value;
  let sede = document.querySelector('#sede').value;
  let motivo = document.querySelector('#motivo').value;

  console.log(sede);
  let dispo = document.querySelector('#dispositivos').value;
  let marca = document.querySelector('#marca').value;
  let serial = document.querySelector('#serial').value;
  let placa = document.querySelector('#placa').value;
  let propietario = document.querySelector('#propietario').value;
  let cantidad = document.querySelector('#cantidad').value;

  let fecha = document.querySelector('#fecha').value;
  let hora = document.querySelector('#hora').value;
  

  if(sede!="Sede TIC" && motivo==""){
    Swal.fire({
      title: 'Información',
      text: 'Por favor especifique el motivo de su visita',
      icon: 'info',   
      confirmButtonText: 'Entendido'
    });
  }else{
    if(documento===""||nombres===""||correo===""||sede===""||fecha===""||hora===""){
      Swal.fire({
        title: 'Error!',
        text: 'Hay campos sin llenar',
        icon: 'danger',
        confirmButtonText: 'Entendido'
      });
     }else{
      Swal.fire({
        title: '¡Genial!',
        text: 'Bienvenido al sistema',
        icon: 'success',
        confirmButtonText: 'Continuar'
      }); 
     }
    }
  }
