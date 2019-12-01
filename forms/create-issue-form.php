<?php
require("../scripts/htmlBuilder.php");

$typeList = ["bug" => "Bug", "proposal" => "Proposal", "task" => "Task"];
$types = options($typeList);

$pList = ["minor" => "Minor", "major" => "Major", "critical" => "Critical"];
$priorities = options($pList);

$action = "../forms/create-issue.php";

echo <<< EOF
<h1>Create Issue</h1>

<form action="{$action}" onsubmit="return validate-user()" method="post">
    <label for="title">Title</label>
    <input type="text" id="title" name="title">
    <br>
    <label for="description">Description</label>
    <input type="text" id="description" name="description">
    <br>
    <label for="assTo">Assigned To</label>
    <select id="assTo" name="assigned_to"><select>
    <br>

    <label for="type">Type</label>
    <select id="type" name="type">
    {$types}
    </select>
    <br>
    <label for="priority">Priority</label>
    <select id="priority" name="priority">
    {$priorities}
    </select>
    <br>
    <input type="submit" value="Submit">
</form>

EOF;