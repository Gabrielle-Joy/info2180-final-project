$(document).ready(() =>{
    // When page first loaded, get the issues log
    issuesQuery();

});

function issuesQuery(filter='') {
    let url = "../php/view-issues.php";
    let query = url;
    if(filter){
        query += "?filter=" + filter;
    }

    fetch(query).then(response => {
        return response.text();
    }).then(data => {
        $("main").html(data);
    });
}

function viewDetailedIssue(id) {
    let url = "../php/detailed-issue.php?id=" + id;
    fetch(url).then(response => {
        return response.text();
    }).then(data => {
        $("main").html(data);
    });
}

function markAsClosed(id) {
    console.log("I hear yah. Close it");
}

function markInProgress(id) {
    console.log("I hear yah. In Progress");
}