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
