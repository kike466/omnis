const formulario = document.getElementById('registrarse_form');
const inputs = document.querySelectorAll('#registrarse_form input');
const formulario2 = document.getElementById('cambiar_perfil');
const inputs2 = document.querySelectorAll('#cambiar_perfil input');


const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{2,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/, // 7 a 14 numeros.
	codPostal: /^(?:0[1-9]|[1-4]\d|5[0-2])\d{3}$/

}

const campos = {

	nombre: false,
	pass: false,
	apellidos: false,
	codigoPostal: false,
	correo: false

}

const validarFormulario = (e) => {
	switch (e.target.name) {

		case "nombre":
			validarCampo(expresiones.nombre, e.target, 'nombre');
			break;
		case "apellidos":
			validarCampo(expresiones.nombre, e.target, 'apellidos');
			break;
		case "codePostal":
			validarCampo(expresiones.codPostal, e.target, 'codePostal');
			break;
		case "pass1":

			validarCampo(expresiones.password, e.target, 'pass1');

			break;
		case "passRe":

			validarPassword2();
			break;
		case "correo":
			validarCampo(expresiones.correo, e.target, 'correo');
			break;

	}
}

const validarFormulario2 = (e) => {
	switch (e.target.name) {

		case "nombre":
			validarCampo2(expresiones.nombre, e.target, 'nombre');
			break;
		case "codePostal":
			validarCampo2(expresiones.codPostal, e.target, 'codePostal');
			break;
		case "pass":
			validarCampo2(expresiones.password, e.target, 'pass');
			break;
		case "correo":
			validarCampo2(expresiones.correo, e.target, 'correo');
			break;

	}
}

const validarCampo = (expresion, input, campo) => {
	if (expresion.test(input.value)) {
		//expresiones.usuario.test(e.target.value)
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.add('correcto');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('incorrecto');
		document.querySelector(`#grupo__${campo} input`).classList.add('correctoB');
		document.querySelector(`#grupo__${campo} input`).classList.remove('incorrectoB');
		campos[campo] = true;

	} else {

		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.add('incorrecto');
		document.querySelector(`#grupo__${campo} i`).classList.remove('correcto');
		document.querySelector(`#grupo__${campo} input`).classList.remove('correctoB');
		document.querySelector(`#grupo__${campo} input`).classList.add('incorrectoB');
		campos[campo] = false;

	}
}
const validarCampo2 = (expresion, input, campo) => {
	if (expresion.test(input.value)) {
		//expresiones.usuario.test(e.target.value)
		document.querySelector(`#grupo__cambiar_${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__cambiar_${campo} i`).classList.add('correcto');
		document.querySelector(`#grupo__cambiar_${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__cambiar_${campo} i`).classList.remove('incorrecto');
		document.querySelector(`#grupo__cambiar_${campo} input`).classList.add('correctoB');
		document.querySelector(`#grupo__cambiar_${campo} input`).classList.remove('incorrectoB');
		campos[campo] = true;

	} else {

		document.querySelector(`#grupo__cambiar_${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__cambiar_${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__cambiar_${campo} i`).classList.add('incorrecto');
		document.querySelector(`#grupo__cambiar_${campo} i`).classList.remove('correcto');
		document.querySelector(`#grupo__cambiar_${campo} input`).classList.remove('correctoB');
		document.querySelector(`#grupo__cambiar_${campo} input`).classList.add('incorrectoB');
		campos[campo] = false;

	}
}



const validarPassword2 = () => {
	const inputPassword1 = document.getElementById('pass1');
	const inputPassword2 = document.getElementById('passRe');

	if (inputPassword1.value !== inputPassword2.value) {
		document.querySelector(`#grupo__pass2 i`).classList.add('incorrecto');
		document.querySelector(`#grupo__pass2 i`).classList.remove('correcto');
		document.querySelector(`#grupo__pass2 i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__pass2 i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__pass2 input`).classList.remove('correctoB');
		document.querySelector(`#grupo__pass2 input`).classList.add('incorrectoB');
		campos['passRe'] = false;

	} else {
		document.querySelector(`#grupo__pass2 i`).classList.remove('incorrecto');
		document.querySelector(`#grupo__pass2 i`).classList.add('correcto');
		document.querySelector(`#grupo__pass2 i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__pass2 i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__pass2 input`).classList.add('correctoB');
		document.querySelector(`#grupo__pass2 input`).classList.remove('incorrectoB');
		campos['passRe'] = true;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

inputs2.forEach((input) => {
	input.addEventListener('keyup', validarFormulario2);
	input.addEventListener('blur', validarFormulario2);
});

formulario.addEventListener('submit', (e) => {


	const terminos = document.getElementById('terminos');
	if (campos.nombre && campos.apellidos && campos.codigoPostal && campos.pass && campos.correo) {
		alert("El usuario ha sido creado con exito");


	} else {
		//e.preventDefault();
	}
});