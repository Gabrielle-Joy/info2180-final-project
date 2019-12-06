<?php
require("valid-session.php");
require("connection.php");

/* One query is for getting all general info on an issue, including who it was assigned to.
The second one is to get who created a specific task.
 */
$basequery1 = "SELECT i.id, title, description as descr, type, priority, status, concat(firstname, ' ', lastname) as assigned_to, 
created, updated FROM issues i JOIN users u ON i.assigned_to = u.id";

$basequery2 = "SELECT concat(firstname, ' ', lastname) as created_by FROM issues i JOIN users u ON i.created_by = u.id";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Sanitize input
    if (strlen($_GET['id']) < 20)
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    else
        return "<p>Bad ID</p>";
    $where = " WHERE i.id = $id";
    $basequery1 .= $where;
    $basequery2 .= $where;
    $results1 = query($basequery1);
    $createdBy = query($basequery2);
    $createdBy = $createdBy['created_by'];
    $title = $results1['title'];
    $desc = $results1['descr'];
    $priority = $results1['priority'];
    $type = $results1['type'];
    $status = $results1['status'];
    $assignedTo = $results1['assigned_to'];
    $created = $results1['created'];
    $created = date_create_from_format("Y-m-d H:i:s", $created);
    $created = date(" F j, Y \a\\t h:i:s A", $created->getTimestamp());
    $updated = $results1['updated'];          
    $updated = date_create_from_format("Y-m-d H:i:s", $updated);
    $updated = date(" F j, Y \a\\t h:i:s A", $updated->getTimestamp());
}
?>

<head>
    <link rel="stylesheet" href="styles/detailedIssue.css">
</head>
<div id="d-main">
    <div id="d-title">
        <h1><?=$title?></h1>
        <h4>Issue #<?=$id?></h4>
    </div>
    <div id="d-desc">
        <p id="desc"><?=$desc?></p>
        <ul>
            <li>Issue Created on <?=$created?> by <?=$createdBy?></li>
            <li>Last Updated on <?=$updated?></li>
        </ul>
    </div>
    <div id="d-stats">
        <h4>Assigned To</h4>
        <p><?=$assignedTo?></p>
        <h4>Type</h4>
        <p><?=$type?></p>
        <h4>Priority</h4>
        <p><?=$priority?></p>
        <h4>Status</h4>
        <p><?=$status?></p>
    </div>
    <div id="d-buttons">
        <button id="btn-closed" onclick="updateIssue(<?=$id?>, 'CLOSED')">Mark as Closed</button>
        <button id="btn-inProg" onclick="updateIssue(<?=$id?>, 'IN PROGRESS')">Mark as In Progress</button>
    </div>
</div>