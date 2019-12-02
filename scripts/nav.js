$(document).ready(() =>{
    // When page first loaded, get the issues log
    issuesQuery();

    // init nav links
    initNav();

});

function issuesQuery(filter='') {
    let url = "../php/view-issues.php";
    let query = url;
    if(filter){
        query += "?filter=" + filter;
    }
    display(query);
}

function viewDetailedIssue(id) {
    let url = "../php/detailed-issue.php?id=" + id;
    display(url);
}

function updateIssue(id, update){
    let url = "../php/update-issue.php";
    let data = {'id': id, 'update': update}
    fetch(url,{
        method: 'POST',
        body: JSON.stringify(data)
    });
    viewDetailedIssue(id);
}

function createIssue() {
    const url = "../forms/create-issue.php";
    display(url);
}

function addUser() {
    const url = "../php/add-user.php";
    // console.log("add user");
    display(url);
}

function logout() {
    const url = "../php/logout.php";
    window.location = url;
    // display(url);
}

function display(url) {
    fetch(url).then(response => {
        return response.text();
    }).then(data => {
        $("main").html(data);
    });
}

function initNav() {
    $("#home").click(() => {issuesQuery()});
    $("#user").click(addUser);
    $("#issue").click(createIssue);
    $("#logout").click(logout);
}

