/**validate_password returns true if a password has at least one capital letter, one digit, 
 * and is at least 8 characters long. False is returned otherwise.
 */
function validate_password(password) {
    let reg = /[A-Z].*\d|\d.*[A-Z]/
    return (reg.test(password) && (password.length >= 8));
}