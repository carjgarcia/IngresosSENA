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

  console.log(id);
  console.log(nombre);
  console.log(correo);
  console.log(sede);
  console.log(vehiculo);
  console.log(dispositivos);
  console.log(fecha);
  console.log(hora);

  event.preventDefault(); 
});

let dispositivos= [
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
            <td><button style="cursor: pointer" onclick="eliminarRegistro(${i})" class="btn btn-outline-danger">Eliminar</button></td>  
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

  let otrodispositivo= $('#otrodis').val();

  if (
    dispo!="ninguno" &&  marca!="" &&  serial!="" &&  propietario!="propietario" &&  cantidad!=""
  ) {
    var registrar=true;
    if (dispo=="otro") {
      if (otrodispositivo=="") {
        Swal.fire({
          title: 'Información',
          text: 'Debe especificar el dispositivo que desea registrar!',
          icon: 'info',   
          confirmButtonText: 'Entendido'
        });
        registrar=false;
      }else{
        registrar=true;
      }
    }else{
      registrar=true;
    }

    if (registrar) {
      dispositivos[dispositivos.length]={
        "Producto": dispo=="otro" ? otrodispositivo : dispo,
        "Marca":marca,
        "Serial":serial,
        "Placa":placa,
        "Propietario":propietario,
        "Cantidad":cantidad
      };
      imprimirRegistros(dispositivos);
      limpiarcampos();
    }
  }else{
    Swal.fire({
      title: 'Información',
      text: 'Por favor especificar los campos obligatorios para registrar dispositivos!',
      icon: 'info',   
      confirmButtonText: 'Entendido'
    });
  }

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
  $("#dispositivos").val("ninguno");
  $('#marca').val(null);
  $('#serial').val(null);
  $('#placa').val(null);
  $('#propietario').val("propietario");
  $('#cantidad').val(null);
  $('#otrodis').val(null);
  posicionSeleccionada=null;
}

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

  let fecha = document.querySelector('#fecha').value;
  let hora = document.querySelector('#hora').value;

  if(sede=="select"){
    Swal.fire({
      title: 'Información',
      text: 'Por favor seleccionar la sede a la que pertenece',
      icon: 'info',   
      confirmButtonText: 'Entendido'
    });
  }else if(sede!="Sede TIC" && motivo==""){
    Swal.fire({
      title: 'Información',
      text: 'Por favor especifique el motivo de su visita',
      icon: 'info',   
      confirmButtonText: 'Entendido'
    });
  }else  if(documento===""||nombres===""||correo===""||sede===""||fecha===""||hora===""){
      Swal.fire({
        title: 'Error!',
        text: 'Hay campos sin llenar',
        icon: 'danger',
        confirmButtonText: 'Entendido'
      });
  }else{
    console.log(fecha);
    $.ajax({
      url:'../ajaxphp/registrar_ingreso.php',
      type:'POST',
      data:{documento,nombres,correo,sede,motivo,dispositivos,fecha,hora},
      success: function(resp){
        setTimeout(() => {
          window.location.href="../generarCodigoQR/index.php"
        }, 1500);
        
        Swal.fire({
          title: '¡Genial!',
          text: 'Bienvenido al sistema',
          icon: 'success',
          confirmButtonText: 'Continuar'
        }); 
      }
    })
  }

  }
