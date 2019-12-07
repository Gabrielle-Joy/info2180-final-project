<?php
require("../php/htmlBuilder.php");
require("../php/get-users.php");

if (isset($errors)) {
    $titleError = $errors["title"];
    $descriptionError = $errors["description"];
    $assignedToError = $errors["assignedTo"];
    $typeError = $errors["type"]; 
    $priorityError = $errors["priority"];  
    unset($errors);
} else {
    $titleError = $descriptionError = $priorityError = $typeError = $assignedToError = "";
    $data["title"] = $data["description"] = $data["type"] = $data["assigned_to"] = $data["priority"] = "";
}


// get users for select field
$ulist = [];
foreach (get_users(["firstname", "lastname", "id"]) as $user) {
    $ulist[$user["id"]] = $user["firstname"] . " " . $user["lastname"];   
}
$users = options($ulist, $selected=$data['assigned_to']);


$typeList = ["Bug" => "Bug", "Proposal" => "Proposal", "Task" => "Task"];
$types = options($typeList, $selected=$data["type"]);
$pList = ["Minor" => "Minor", "Major" => "Major", "Critical" => "Critical"];
$priorities = options($pList, $selected=$data["priority"]);
$action = "../php/create-issue.php";

?>

<h1>Create Issue</h1>
<form onsubmit="return validateIssue()">
    <label for="title">Title</label><br>
    <input type="text" id="title" name="title" value="<?=$data["title"]?>">
    <span class="error">* <?php echo $titleError;?></span>
    <br><br>

    <label for="description">Description</label><br>
    <textarea name="description" id="description" cols="30" rows="8"><?=$data["description"]?></textarea>
    <span class="error">* <?php echo $descriptionError;?></span>
    <br><br>

    <label for="assTo">Assigned To</label><br>
    <select id="assTo" name="assigned_to">
        <?=$users?>
    <select>
    <span class="error">* <?php echo $assignedToError;?></span>
    <br><br>

    <label for="type">Type</label><br>
    <select id="type" name="type">
        <?=$types?>
    </select>
    <span class="error">* <?php echo $typeError;?></span>
    <br><br>

    <label for="priority">Priority</label><br>
    <select id="priority" name="priority">
        <?=$priorities?>
    </select>
    <span class="error">* <?php echo $priorityError;?></span>
    <br><br>

    <input type="submit" value="Submit">
</form>
