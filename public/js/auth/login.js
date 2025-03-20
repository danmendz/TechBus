document.addEventListener("DOMContentLoaded", function () {
	const form = document.querySelector("form");
	const emailInput = document.getElementById("email");
	const passwordInput = document.getElementById("password");
	const togglePassword = document.querySelector("#togglePassword");
	const captchaError = document.getElementById("captchaError");

	// Validación del correo electrónico en tiempo real
	emailInput.addEventListener("input", function () {
		if (!isValidEmail(emailInput.value)) {
			emailInput.classList.add("border-red-500");
			emailInput.classList.remove("border-gray-200");
		} else {
			emailInput.classList.remove("border-red-500");
			emailInput.classList.add("border-gray-200");
		}
	});

	// Validación de la contraseña en tiempo real
	passwordInput.addEventListener("input", function () {
		if (passwordInput.value.length < 8) {
			passwordInput.classList.add("border-red-500");
			passwordInput.classList.remove("border-gray-200");
		} else {
			passwordInput.classList.remove("border-red-500");
			passwordInput.classList.add("border-gray-200");
		}
	});

  
	togglePassword.addEventListener("click", function (e) {
	const type =
		password.getAttribute("type") === "password" ? "text" : "password";
		password.setAttribute("type", type);
		// toggle the eye / eye slash icon
		this.classList.toggle("bi-eye");
	});

	// Validación del formulario antes de enviar
	form.addEventListener("submit", function (event) {
		let isValid = true;

		if (!isValidEmail(emailInput.value)) {
			isValid = false;
			emailInput.classList.add("border-red-500");
		}

		if (passwordInput.value.length < 6) {
			isValid = false;
			passwordInput.classList.add("border-red-500");
		}

		// if (!grecaptcha.getResponse()) {
		// 	isValid = false;
		// 	captchaError.textContent = "Por favor, completa el reCAPTCHA.";
		// 	captchaError.classList.add("text-red-500", "text-sm");
		// } else {
		// 	captchaError.textContent = "";
		// }

		if (!isValid) {
			event.preventDefault();
		}
	});

	function isValidEmail(email) {
		const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		return emailPattern.test(email);
	}
});