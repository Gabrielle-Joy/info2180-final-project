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

function createIssue() {
    const url = "../forms/create-issue.php";
    display(url);
}

function addUser() {
    const url = "../forms/add-user.php";
    console.log("add user");
    display(url);
}

function validateUser() {
    let valid = true;
    const fname = $("#fname").val();
    const lname = $("#lname").val();
    const pass = $("#password").val();
    const email = $("#email").val();

    if (valid) {
        const url = "../php/add-user.php";
        const data = {
            "firstname": fname,
            "lastname": lname,
            "password": pass,
            "email":    email
        };
        display(url, body=data);
    }
}

function logout() {
    const url = "../php/logout.php";
    window.location = url;
    // display(url);
}

async function display(url, body=null) {
    // alert(url);
    let data;
    if (body) {
        // POST request
        // alert(body.JSON());
        data = await post(url, body);
    } else {
        // GET request
        data = await get(url);
    }
    if(data) {
        // console.log(data);
        $("main").html(data);
    } else {
        console.error("request failed");
    }
}

async function post(url, pbody={}) {
    let result;
    console.log("Post");
    let fd = formData(pbody);
    alert(fd);
    await fetch(url, {
        method: 'POST',
        body: fd
    })
    .then(response => response.text())
    .then(data => result = data )
    .catch(error => console.error(error));
    // console.log(result);
    return result;
}

async function get(url) {
    let result;
    // console.log("Get");
    await fetch(url)
    .then(response => response.text())
    .then(data => result = data )
    .catch(error => console.error(error));
    // console.log(result);
    return result;
}

function initNav() {
    $("#home").click(() => {issuesQuery()});
    $("#user").click(addUser);
    $("#issue").click(createIssue);
    $("#logout").click(logout);
}

function formData(list) {
    let fd = new FormData();
    for(var i in list){
        fd.append(i,list[i]);
    }
    return fd;
}

function markAsClosed(id) {
    console.log("I hear yah. Close it");
}

function markInProgress(id) {
    console.log("I hear yah. In Progress");
}