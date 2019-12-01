<?php

if (isset($_SESSION["errors"])) {
    $fnError = $_SESSION["errors"]["firstname"];
    $lnError = $_SESSION["errors"]["lastname"];
    $pError = $_SESSION["errors"]["password"];
    $emError = $_SESSION["errors"]["email"];  
} else {
    $fnError = $lnError = $pError = $emError = "";
}

$action = "../php/add-user.php";
?>

<h1>New User</h1>
<p><span class="error">* required field</span></p>
<form onsubmit="validateUser()">
    Firstname<br>
    <input id="fname" type="text" name="Fname" value="<?php echo $Fname;?>">
    <span class="error">* <?php echo $fnError;?></span>
    <br><br>
    Lastname<br>
    <input id="lname" type="text" name="Lname" value="<?php echo $Lname;?>">
    <span class="error">* <?php echo $lnError;?></span>
    <br><br>
    Password<br>
    <input id="password" type="password" name="Pass" value="<?php echo $Pass;?>">
    <span class="error">* <?php echo $pError;?></span>
    <br><br>
    Email<br>
    <input id="email" type="text" name="Email" value="<?php echo $Email;?>">
    <span class="error">* <?php echo $emError;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>