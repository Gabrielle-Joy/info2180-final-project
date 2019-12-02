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
    console.log(url);
    console.log("Let's Roll");
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
    const url = "../forms/add-user.php";
    display(url);
}

function validateUser() {
    let valid = true;
    const fname = $("#fname").val();
    const lname = $("#lname").val();
    const pass = $("#password").val();
    const email = $("#email").val();

    //validate the inputs here

    //if inputs are valid
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
    return false;
}

function validateIssue() {
    let valid = true;
    const title = $("#title").val();
    const description = $("#description").val();
    const assTo = $("#assTo").val();
    const type = $("#type").val();
    const priority = $("#priority").val();
    console.log(priority);

    if (valid) {
        const url = "../php/create-issue.php";
        const data = {
            "title": title,
            "description": description,
            "assigned_to": assTo,
            "type": type,
            "priority" : priority,
        }
        display(url, body=data);
    }

    return false;
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
        data = await post(url, body);
    } else {
        // GET request
        data = await get(url);
    }
    if(data) {
        $("main").html(data);
    } else {
        console.error("request failed");
    }
}

async function post(url, pbody={}) {
    let result;
    let fd = formData(pbody);
    await fetch(url, {
        method: 'POST',
        body: fd
    })
    .then(response => response.text())
    .then(data => result = data )
    .catch(error => console.error(error));
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
