<?php

require_once("connection.php");
require("valid-session.php");

$basequery = "INSERT INTO issues (title, description, type, priority, status, assigned_to, created_by, created, updated) VALUES 
(:title, :description, :type, :priority, :status, :assigned_to, :created_by, NOW(), NOW())";
$basequery2 = "INSERT INTO issues (title, description, type, priority, status, assigned_to, created_by, created, updated) VALUES 
 ('Setting up Detailed Issue View', 'When a user clicks on the issue, a detailed description is brought up','Proposal', 'Medium', 'IN PROGRESS', 1, 1, NOW(), NOW())";

$statement = $conn->prepare($basequery);

$errors = [
    "title" => "",
    "description"  => "",
    "type"     => "",
    "priority"  => "",
    "assignedTo"  => "",
];

$data;

function handleRequest( $statement ) {
    global $errors;
    global $data;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_filter($_POST);
        // $statement->bindParam(':title', $data["title"]);

        if (validate($data)) {
            $current_date = date("Y-m-d");
            $status = "OPEN";

            $params = [
                ':title'        => $data['title'],
                ':description'  => $data['description'],
                ':type'         => $data['type'],
                ':priority'     => $data['priority'],
                ':status'       => $status,
                ':assigned_to'  => $data['assigned_to'],
                ':created_by'   => $_SESSION['user']
            ];   

            $statement->execute($params);
            require("../forms/issue-success.php");
        } else {
            // display form 
            storeErrors($errors);
            require("../forms/create-issue.php");
        }
    } else {
        alertError("Invalid request type");
        echo "false";
    }
}

function validate($dt) {
    // title
    global $errors;
    global $data;
    $title = empty($data["title"]);
    if ( $title ){
        $errors["title"] = "Must enter title";
        $data["title"] = "";
    }

    $description = empty($data["description"]);
    if ( $description ){
        $errors["description"] = "Must enter description";
        $data["description"] = "";
    }

    $type = empty($data["type"]);
    if ( $type ){
        $errors["type"] = "Must select a type";
        $data["type"] = "";
    }

    $priority = empty($data["priority"]);
    if ( $priority ){
        $errors["priority"] = "Must select a priority";
        $data["priority"] = "";
    }

    $assigned_to = empty($data["assigned_to"]);
    if ( $assigned_to ){
        $errors["assignedTo"] = "Must assign user to issue";
        $data["assigned_to"] = "";
    }

    return !($title || $description || $type || $priority || $assigned_to);
}

handleRequest($statement);

?>


