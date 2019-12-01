<?php
# Database Credentials
$username = 'bugmeboss';
$host = getenv('IP');
$dbname = 'bugmedb';
$password = 'tracker';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function closeConnection() {
    global $conn;
    $conn = null;
}

function query($query, $many=false) {
    global $conn;
    $stmt = $conn->query($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // if ($many) {
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // } else {
    //     return $stmt->fetch();
    // }
}
?>