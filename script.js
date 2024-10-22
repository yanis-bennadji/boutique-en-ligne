let signupBtn = document.getElementById("signupBtn");
let signinBtn = document.getElementById("signinBtn");
let firstnameField = document.getElementById("firstnameField");
let lastnameField = document.getElementById("lastnameField");
let title = document.getElementById("title");

eel.expose(getUserEmail);
function getUserEmail() {
    var email = document.getElementById("email").value;
    return email
}

// eel.expose(getUserPasswd);
// function getUserPasswd() {
//     var passwd = document.getElementById("passwd").value;
//     return passwd
// }

function Signin() {
    // firstnameField.style.maxHeight = "0%";
    // lastnameField.style.maxHeight = "0%";
    // title.innerHTML = "Sign In";
    // signupBtn.classList.add("disabled");
    // signinBtn.classList.remove("disabled");

    var email = document.getElementById("email").value;
    var password_hash = document.getElementById("password").value;
    eel.Signin(email, password_hash);
}

eel.expose(redirect_chat);
function redirect_chat() {
    // window.location.href = '';
}

function Signup() {
    // firstnameField.style.maxHeight = "100%";
    // lastnameField.style.maxHeight = "100%";
    // title.innerHTML = "Sign Up";
    // signupBtn.classList.remove("disabled");
    // signinBtn.classList.add("disabled");
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var email = document.getElementById("email").value;
    var password_hash = document.getElementById("password").value;
    eel.Signup(nom, prenom, email, password_hash);
}

// function hidden() {
//     let signup = document.getElementById("signupBtn");
//     let signin = document.getElementById("signinBtn");
//     let inscription = document.getElementById("inscription");
//     signup.addEventListener("click", () => {
//         if (getComputedStyle(inscription).display != "none") {
//             inscription.style.display = "block"
//         }

//     })

// }
