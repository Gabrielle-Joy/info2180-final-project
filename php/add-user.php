<?php
require("connection.php");
require_once("valid-session.php");
$basequery = "INSERT INTO users (firstname, lastname, password, email, date_joined)
                VALUES (:firstname, :lastname, :password, :email, :date_joined)";
$statement = $conn->prepare($basequery);
// $Fname=$Lname=$Pass=$Email="";
$errors = [
    "firstname" => "",
    "lastname"  => "",
    "email"     => "",
    "password"  => ""
];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["firstname"])) {
        $errors["firstname"]="Must Enter Your First Name";
        $Fname='';
    } else {
        $Fname=data_input($_POST["firstname"]);
        filter_var($Fname,FILTER_SANITIZE_STRING);
        if(!ctype_alpha($Fname)){
            // $Fname='';
            $errors["firstname"]="Only letters should be entered";
        }
    }

    if(empty($_POST["lastname"])){
        $errors["lastname"]="Must Enter Your Last Name";
        $Lname='';
    } else {
        $Lname=data_input($_POST["lastname"]);
        filter_var($Lname,FILTER_SANITIZE_STRING);
        if(!ctype_alpha($Lname)){
            $errors["lastname"]="Only letters should be entered";
            // $Lname='';
        }
    }

    if(empty($_POST["email"])){
        $errors["email"]="Must Enter Your Email";
        $Email='';
    } elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
        $errors["email"]="Invalid Email Format Entered";
        $Email=data_input($_POST["email"]);;
    } else {
        $Email=data_input($_POST["email"]);
        $stmt=$conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$Email]);
        $user=$stmt->fetch();
        if($user){
            $errors["email"]="Email Already In Use Please Enter Another Email Address";
            $Email='';
        }
        
    }
    if(empty($_POST["password"])){
        $errors["password"]="Must Enter a Password";
        $Pass='';
    }
    else{
        $Pass=data_input($_POST["password"]);
        if(strlen($_POST["password"])<8){
            $errors["password"]="Password must have at least 8 characters and 1 Number and 1 Capital Letter";
            $Pass='';
        }
        elseif (!preg_match("#.*^(?=.{8,})(?=.*[A-Z])(?=.*[0-9]).*$#",$Pass)){
            $errors["password"]="Password must have at least 8 characters and 1 Number and 1 Capital Letter";
            $Pass='';
        }
    }
    if(empty($errors["firstname"])&&empty($errors["lastname"])&&empty($errors["password"])&&empty($errors["email"])){
        // wipeErrors();
        submit_info($conn);
        require("../forms/user-success.php");
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

function wipeErrors(){
    if (isset($_SESSION["errors"])) {
        unset($_SESSION["errors"]);
    }
    
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
}
?>