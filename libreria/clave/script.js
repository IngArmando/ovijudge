 var longitud;
 var letra;
 var mayus;
 var numero;
 var especial;
$(document).ready(function() {

$('#clave').keyup(function() {
	// set password variable
	var pswd = $(this).val();
	//validate the length
if ( pswd.length < 8 ) {
	longitud=false;
	$('#length').removeClass('valid').addClass('invalid');
} else {
	longitud=true;
	$('#length').removeClass('invalid').addClass('valid');
}
//validate letter
if ( pswd.match(/[A-z]/) ) {
	letra=true;
	$('#letter').removeClass('invalid').addClass('valid');
} else {
	letra=false;
	$('#letter').removeClass('valid').addClass('invalid');
}

//validate capital letter
if ( pswd.match(/[A-Z]/) ) {
	mayus=true;
	$('#capital').removeClass('invalid').addClass('valid');
} else {
	mayus=false;
	$('#capital').removeClass('valid').addClass('invalid');
}

//validate number
if ( pswd.match(/\d/) ) {
	numero=true;
	$('#number').removeClass('invalid').addClass('valid');
} else {
	numero=false;
	$('#number').removeClass('valid').addClass('invalid');
}
//especial
if ( pswd.match(/\W/) ) {
	especial=true;
	$('#especial').removeClass('invalid').addClass('valid');
} else {
	especial=false;
	$('#especial').removeClass('valid').addClass('invalid');
}

}).focus(function() {
	$('#pswd_info').show();
}).blur(function() {
	$('#pswd_info').hide();
});




});

function validar(){
	
	if(letra==false || longitud==false || mayus==false || numero==false || especial==false){
		alert("Por favor verifique su contraseña debe cumplir con los requerimientos minimos.");
		return false;
		}
		
	clave=document.getElementById("clave");
	con_clave=document.getElementById("con_clave");
	if(clave.value!=con_clave.value){
		alert("Disculpe, sus claves no coinciden, Corrija e Intente nuevamente.");
		return false;
		}
}


