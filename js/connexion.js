function invalidEmail(email) {
    const regexEmail = /^[a-zA-Z0-9.]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    return !regexEmail.test(email);
}

const email = document.getElementById("email");
const errorEmail = document.getElementById("errorEmail");

email.addEventListener("input", (event) => {
    if (invalidEmail(email.value)) {
        email.classList.add("errorField");
        errorEmail.innerHTML = "Email invalide";
    } else {
        email.classList.remove("errorField");
        errorEmail.innerHTML = "";
    }
});

function invalidMdp(mdp){
    const regexMdp = /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).*$/;
    return !regexMdp.test(mdp);
}

const mdp = document.getElementById("mdp");
const errorMdp = document.getElementById("errorMdp");

mdp.addEventListener("input", (event) => {
    if (invalidMdp(mdp.value)) {
        mdp.classList.add("errorField");
        errorMdp.innerHTML = "Mot de passe invalide";
    } else {
        mdp.classList.remove("errorField");
        errorMdp.innerHTML = "";
    }
});
