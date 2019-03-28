const signUp = document.getElementById("signUpForm");
const logIn = document.getElementById("loginForm");

function openLoginForm() {
	logIn.style.display = "block";
	signUp.style.display = "none";
}

function closeLoginForm() {
	logIn.style.display = "none";
}

function openSignUpForm() {
	signUp.style.display = "block";
	logIn.style.display = "none";
}

function closeSignUpForm() {
	signUp.style.display = "none";
	logIn.style.display = "none";
}

// Remove after a period of time message for loggin or loggout 
const msgremove = document.getElementById("msg");
let timer = 4000;

setTimeout(function () {
	msgremove.style.display = "none";
}, timer);
