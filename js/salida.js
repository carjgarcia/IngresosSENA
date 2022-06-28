

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