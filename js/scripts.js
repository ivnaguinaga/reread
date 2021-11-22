function validar() {
    let email = document.getElementById('email').value
    let pass = document.getElementById('password').value
    if (email == "" || password == "") {
        alert("Hay un campo vacio")
        return false
    }
}