<?php

require("connection.php");
require("htmlBuilder.php");

$basequery = "SELECT id, title, type, status, assigned_to, created FROM issues";

function handleRequest( $conn ) {
    global $basequery;
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $queries = array_filter($_GET);
        if ( isset($queries["filter"]) ) {
            filterIssues($conn, $queries["filter"], $id=$queries["id"]);
        } else {
            viewAllIssues( $conn );
        }
    } else {
        alertError("Not appropriate request method");
    }
}

function viewAllIssues( $conn ) {
    global $basequery;
    $results = query( $conn, $basequery, $many=true);
    $response = makeResponse( $results );

    echo $response;
}

function filterIssues ( $conn, $filter, $id=null ) {
    global $basequery;
    // set where clause based on filter
    $where =( $filter === "open") ? "WHERE status = {$filter}" : 
            ( $filter === "my") ? "WHERE assigned_to = {$id}" : "";
    if ( $where != "" ) {
        $sqlquery = $basequery . " {$where}";
        $results = query( $conn, $sqlquery, $many=true );
        $response = makeResponse($results);
    } else {
        alertError("Invalid filter");
    }
    
    
    echo $response;
}

function makeResponse( $results ) {
    $htmlresponse = "";
    $headings = ["Ticket ID", "Title", "Type", "Status", "Assigned To", "Created"];
    $dbfields = ["id", "title", "type", "status", "assigned_to", "created_by"];

    $table_headings = table_headings($headings);
  
    $table_data = "";
    
    foreach( $results as $row ) {
        $row_data = "";
        foreach( $dbfields as $field ) {
            $row_data .= td($row[$field]);
        }
        $table_data .= tr($row_data);
    }

    return table("{$table_headings}{$table_data}");
}

handleRequest($conn);
?>