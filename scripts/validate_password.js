function validate_password(password) {
    // Checks if the password contains letters - at least one is capital - a digit, and is 8 characters or longer
    let reg = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.[0-9])(?=.{8,50})");
    return reg.test(password);
}