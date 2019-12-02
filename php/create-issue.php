<?php

require("connection.php");
require("valid-session.php");

$basequery = "INSERT INTO issues (title, description, type, priority, status, assigned_to, created_by, created, updated) 
                VALUES (:title, :description, :type, :priority, :status, :assigned_to, :created_by, NOW(), NOW())";
$statement = $conn->prepare($basequery);

function handleRequest( $statement ) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_filter($_POST);
        // $statement->bindParam(':title', $data["title"]);
        $current_date = date("Y-m-d");
        $status = "Open";

        $params = [
            ':title'        => $data['title'],
            ':description'  => $data['description'],
            ':type'         => $data['type'],
            ':priority'     => $data['priority'],
            ':status'       => $status,
            ':assigned_to'  => $data['assigned_to'],
            ':created_by'   => $_SESSION['user']
            /*
            ':created'      => $current_date,
            ':updated'      => $current_date
            */
        ];   
        var_dump($params);
        
        $statement->execute($params);
        // header("Location: ../index.php");

    } else {
        alertError("Invalid request type");
        echo "false";
    }
}

handleRequest($statement);

?>


