<?php
require("valid-session.php");
require("connection.php"); 

$basequery = "UPDATE issues SET status = :stat, updated = NOW() WHERE id = :id";
$statement = $conn->prepare($basequery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = (array) json_decode($json);
    $id = $data['id'];
    $id = filter_var($id,FILTER_SANITIZE_NUMBER_INT);
    $status = $data['update'];
    if ($status == "CLOSED") {
        $good = True;
    } elseif ($status == "IN PROGRESS") {
        $good = True;
    } else
        $good = False;
    var_dump($status);
    $params = [
        ':stat' => $status,
        ':id'   => $id
    ];
    if ($good)
        $statement->execute($params);
    
}

?>