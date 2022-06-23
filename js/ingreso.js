/* var select = document.getElementById("propietario");
select.addEventListener("change", function () {
  var selectedOption = this.options[select.selectedIndex];
  console.log(selectedOption.value + ": " + selectedOption.text);
}); */
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
var dispo = document.getElementById("dispositivo");
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

function imprimirDatos() {
  const id = document.getElementById('idDocumento').value;
  const nombre = document.getElementById('nombres').value;
  const correo = document.getElementById('correo').value;
  const sede = document.getElementById('sede').value;
  /*Extraer el valor seleccionado de los radio buttons a través de un query con CSS*/
  const vehiculo = document.querySelector('input[name="vehiculo"]:checked').value;

  /*Manipulación de la tabla*/
  let articulos = [];
  let tabla = document.getElementById('tablaDispositivos');
  let filas = tabla.getElementsByTagName('tbody')[0];
  let numFilas = filas.children.length;
  // let columnas = tabla.querySelectorAll('tr th');
  // let numCol = columnas.length;
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

  console.log(id, nombre, correo, sede, vehiculo, articulos, fecha, hora);
}
