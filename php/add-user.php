<?php
require("connection.php");
$basequery = "INSERT INTO users (firstname, lastname, password, email, date_joined)
                VALUES (:firstname, :lastname, :password, :email, :date_joined)";
$statement = $conn->prepare($basequery);
//$newquery="SELECT * from 'users'";
$Fname=$Lname=$Pass=$Email="";
$errors = [
    "firstname" => "",
    "lastname"  => "",
    "email"     => "",
    "password"  => ""
];

$fnError=$lnError=$pError=$emError="";

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["firstname"])){
        $fnError="Must Enter Your First Name";
    }
    else{
        $Fname=data_input($_POST["firstname"]);
        filter_var($Fname,FILTER_SANITIZE_STRING);
        if(!ctype_alpha($Fname)){
        $Fname='';
        $fnError="Only letters should be entered";
        }
    }
    if(empty($_POST["lastname"])){
        $lnError="Must Enter Your Last Name";
    }
    else{
        $Lname=data_input($_POST["lastname"]);
        filter_var($Lname,FILTER_SANITIZE_STRING);
        if(!ctype_alpha($Lname)){
        $lnError="Only letters should be entered";
        $Lname='';
        }
    }
    if(empty($_POST["email"])){
        $emError="Must Enter Your Email";
    }
    else{
        $Email=data_input($_POST["email"]);
        $stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$Email]);
        $user=$stmt->fetch();
        if($user){
        $emError="Email Already In Use Please Enter Another Email Address";
        $Email='';
        }
        elseif(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
        $emError="Invalid Email Format Entered";
        $Email='';
        }
    }
    if(empty($_POST["password"])){
        $pError="Must Enter a Password";
    }
    else{
        $Pass=data_input($_POST["password"]);
        if(strlen($_POST["password"])<8){
        $pError="Password must have at least 8 characters and 1 Number and 1 Capital Letter";
        $Pass='';
        }
        elseif (!preg_match("#.*^(?=.{8,})(?=.*[A-Z])(?=.*[0-9]).*$#",$Pass)){
        $pError="Password must have at least 8 characters and 1 Number and 1 Capital Letter";
        $Pass='';
        }
    }
    if(empty($fnError)&&empty($lnError)&&empty($pError)&&empty($emError)){
        wipeErrors();
        submit_info($conn);
    } else {
        // display form 
        storeErrors($errors);
        require("../forms/add-user.php");
    }
}
function data_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function storeErrors($errors) {
    $_SESSION["errors"] = $errors;
}

function wipeErrors(){
    unset($_SESSION["errors"]);
}

function submit_info($conn){
    global $statement;
    $data = array_filter($_POST);
    $statement->bindParam(':firstname', $data["firstname"]);
    $current_date = date("Y-m-d");
    $pass_hash=md5($data['password']);
    $params = [
        ':firstname'    => $data['firstname'],
        ':lastname'     => $data['lastname'],
        ':password'     => $pass_hash,
        ':email'        => $data['email'],
        ':date_joined'  => $current_date,
    ];
    $statement->execute($params);
    // echo "<meta http-equiv='refresh' content='0'>";
    // header("Location: ../index.php");
}
?>

<h1> ERROR </h1>