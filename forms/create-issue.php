<?php
require("../php/htmlBuilder.php");
require("../php/get-users.php");

// get users for select field
// $users = get_users(["firstname", "lastname", "id"]);
$ulist = [];
// var_dump(get_users(["firstname", "lastname", "id"]));
foreach (get_users(["firstname", "lastname", "id"]) as $user) {
    // var_dump($user);
    $ulist[$user["id"]] = $user["firstname"] . " " . $user["lastname"];   
}
// var_dump($ulist);
$users = options($ulist);


$typeList = ["bug" => "Bug", "proposal" => "Proposal", "task" => "Task"];
$types = options($typeList);
$pList = ["minor" => "Minor", "major" => "Major", "critical" => "Critical"];
$priorities = options($pList);
$action = "../php/create-issue.php";

?>

<h1>Create Issue</h1>
<form action="<?=$action?>" onsubmit="return validate-issue()" method="post">
    <label for="title">Title</label>
    <input type="text" id="title" name="title">
    <br>
    <label for="description">Description</label>
    <input type="text" id="description" name="description">
    <br>
    <label for="assTo">Assigned To</label>
    <select id="assTo" name="assigned_to">
        <?=$users?>
    <select>

    <br>
    <label for="type">Type</label>
    <select id="type" name="type">
        <?=$types?>
    </select>
    <br>

    <label for="priority">Priority</label>
    <select id="priority" name="priority">
        <?=$priorities?>
    </select>
    <br>

    <input type="submit" value="Submit">
</form>
