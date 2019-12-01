<?php
require("sessionTest.php");
require("connection.php");
require("htmlBuilder.php");

$basequery = "SELECT i.id, title, type, status, concat(firstname, ' ', lastname) as assigned_to, 
created FROM issues i JOIN users u ON i.assigned_to = u.id";

function handleRequest() {
    global $basequery;
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $queries = array_filter($_GET);
        if ( isset($queries["filter"]) ) {
            filterIssues($queries["filter"], $id=$_SESSION["user"]);
        } else {
            viewAllIssues();
        }
    } else {
        alertError("Not appropriate request method");
    }
}

function viewAllIssues() {
    global $basequery;
    $results = query($basequery, $many=true);
    $response = makeResponse($results);
    // print_r($results);

    echo $response;
}

function filterIssues ($filter, $id=null ) {
    global $basequery;
    // set where clause based on filter
    // echo "Filter: $filter ";
    $where = ( $filter == "open") ? "WHERE status = '{$filter}'" : "";
    $where = ( $filter == "my") ? "WHERE assigned_to = {$id}" : $where;
    if ( $where != "" ) {
        $sqlquery = $basequery . " {$where}";
        // echo $sqlquery;
        $results = query($sqlquery, $many=true);
        $response = makeResponse($results);
    } else {
        alertError("Invalid filter");
    }
    
    echo $response;
}

function makeResponse( $results ) {
    $htmlresponse = "";
    $headings = ["Ticket ID", "Title", "Type", "Status", "Assigned To", "Created"];
    $dbfields = ["id", "title", "type", "status", "assigned_to", "created"];

    $table_headings = table_headings($headings, "tbl-head");
  
    $table_data = "";
    
    foreach( $results as $row ) {
        $row_data = "";
        foreach( $dbfields as $field ) {
            $row_data .= td($row[$field]);
            //var_dump($row_data);
        }
        $table_data .= tr($row_data,$id=$row["id"]);
    }

    return table("{$table_headings}{$table_data}");
}

?>

<div>
    <h1>Issues</h1>
    <button id="new-issue-btn" onclick="createIssue()">Create New Issue</button>
</div>
<div id="filter-select">
    <p>Filter by: </p>
    <button id="all" onclick="issuesQuery()">ALL</button>
    <button id="open" onclick="issuesQuery('open')">OPEN</button>
    <button id="my" onclick="issuesQuery('my')">MY TICKETS</button>
</div>
<br>

<?php
handleRequest();

?>