/** This Function pre-validates the password before submitting to the server.
 * If a password doesn't meet this basic regex, then it can't be a valid password 
 * */ 
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