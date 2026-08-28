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
        errorMdp.innerHTML = "Mot de passe invalide (Il doit contenir au moins 8 caractères, une minuscule, une majuscule, un chiffre et un caractère spécial)";
    } else {
        mdp.classList.remove("errorField");
        errorMdp.innerHTML = "";
    }
});