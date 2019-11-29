<?php
require("../scripts/htmlBuilder.php")

$types = []

echo <<< EOF
<h1>Create Issue</h1>

<form action="" onsubmit="return validate-user()">
    <label for="title">Title</label>
    <input type="text" id="title" name="title">

    <label for="description">Description</label>
    <input type="text" id="description" name="description">

    <label for="assTo">Assigned To</label>
    <select id="assTo" name="assigned_to" size="4">
    {users}

    <label for="type">Type</label>
    <select id="type" name="type" size="4">
    <option value="bug">Bug</option>
    <option value="bug">Bug</option>
    <option value="bug">Bug</option>

    <label for="priority">Priority</label>
    <select id="priority" name="priority" size="4">
    {priority}

    <input type="submit" value="Submit">
</form>

EOF;