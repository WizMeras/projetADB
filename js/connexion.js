// Retourne true si l'adresse e-mail ne respecte pas le format attendu
function invalidEmail(email) {
    const regexEmail = /^[a-zA-Z0-9.]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    return !regexEmail.test(email);
}

// Recupere les elements du formulaire et du message d'erreur associé
const email = document.getElementById("email");
const errorEmail = document.getElementById("errorEmail");

// Valide l'adresse e-mail a chaque modification du champ
email.addEventListener("input", (event) => {
    if (invalidEmail(email.value)) {
        email.classList.add("errorField");
        errorEmail.innerHTML = "Email invalide";
    } else {
        email.classList.remove("errorField");
        errorEmail.innerHTML = "";
    }
});

// Retourne true si le mot de passe ne respecte pas les critéres de securité
function invalidMdp(mdp){
    const regexMdp = /^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).*$/;
    return !regexMdp.test(mdp);
}

// Recupére le champ du mot de passe et son message d'erreur
const mdp = document.getElementById("mdp");
const errorMdp = document.getElementById("errorMdp");

// Valide le mot de passe a chaque modification du champ
mdp.addEventListener("input", (event) => {
    if (invalidMdp(mdp.value)) {
        mdp.classList.add("errorField");
        errorMdp.innerHTML = "Mot de passe invalide";
    } else {
        mdp.classList.remove("errorField");
        errorMdp.innerHTML = "";
    }
});
