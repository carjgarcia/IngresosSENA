const contenedorQR = document.getElementById('contenedorQR');
const formulario = document.getElementById('formulario');

const QR = new QRCode(contenedorQR);

$.ajax({
	url:'./cargarinformacion.php',
	type: 'POST',
	success: function(resp){
		QR.makeCode(resp);
	}
})
/* formulario.addEventListener('submit', (e) => {
	e.preventDefault();
}); */
