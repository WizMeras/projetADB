function invalidEmail(email) {
    const regex = /^[a-zA-Z0-9.]+@[a-zA-Z0-9-]+\.[a-zA-Z]+$/;
    return !regex.test(email);
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
