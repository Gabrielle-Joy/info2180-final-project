<?php

require("connection.php");

$basequery = "INSERT INTO issues (title, description, type, priority, status, assigned_to, created_by, created, updated) 
                VALUES (:title, :description, :type, :priority, :status, :assigned_to, :created_by, :created, :updated)";
$statement = $conn->prepare($basequery);

function handleRequest( $conn ) {
    global $statement;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_filter($_POST);
        $statement->bindParam(':title', $data["title"]);
        $current_date = date("Y-m-d");
        $status = "Open";

        $params = [
            ':title'        => $data['title'],
            ':description'  => $data['description'],
            ':type'         => $data['type'],
            ':priority'     => $data['priority'],
            ':status'       => $status,
            ':assigned_to'  => $data['assigned_to'],
            ':created_by'   => $data['created_by'],
            ':created'      => $current_date,
            ':updated'      => $current_date
        ];   
        
        $statement->exec($params);
        echo "true";

    } else {
        alertError("Invalid request type");
        echo "false";
    }
}

?>


