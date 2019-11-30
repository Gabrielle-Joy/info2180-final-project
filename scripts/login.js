// import validate_password from 'validate_password.js';

function login_check(password) {
    console.log("P:" + password.value);
    good = validate_password(password.value);
    console.log("G:" + good);
    if (good) {
        return true;
    } else {
        $("#messages").html("<h3>Incorrect Email or Password</h3>");
        return false;
    }
}