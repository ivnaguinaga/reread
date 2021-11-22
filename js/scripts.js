function validar() {
    let email = document.getElementById('email').value
    let pass = document.getElementById('password').value
    if (email == "" || pass == "") {
        document.getElementById('mensaje').innerText = "email* contraseña*"
        return false
    }

}