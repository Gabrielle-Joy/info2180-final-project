let display = $("#display");
let baseURL = "http://localhost:8080/";

$( document ).ready(function() {
    goHome();
    initNav();
});


/**
 * create action listeners for relevant nav items
 */
function initNav() {
    $("#home").click(goHome);
    $("#add-user").click(addUser);
    $("#new-issue").click(createIssue);
    $("#logout").click(logout);
}

function goHome() {
    const url = `${baseURL}/view-issues.php`;
    fetch(url)
}

function addUser() {
    const url = baseURL + "forms/add-user.php";
    fetch()
}

function createIssue() {
    const url = baseURL + "forms/create-issue.php";
}

function logout() {
    
}