<?php
require("connection.php");
require("valid-session.php");
$basequery = "INSERT INTO users (firstname, lastname, password, email, date_joined)
                VALUES (:firstname, :lastname, :password, :email, :date_joined)";
$statement = $conn->prepare($basequery);
//$newquery="SELECT * from 'users'";
$fnError=$lnError=$pError=$emError="";
$Fname=$Lname=$Pass=$Email="";
$errors = [
    "firstname" => $fnError,
    "lastname"  => $lnError,
    "email"     => $pError,
    "password"  => $emError
];




if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST["firstname"])){
        $errors["firstname"]="Must Enter Your First Name";
    }
    else{
        $Fname=data_input($_POST["firstname"]);
        filter_var($Fname,FILTER_SANITIZE_STRING);
        if(!ctype_alpha($Fname)){
            $Fname='';
            $errors["firstname"]="Only letters should be entered";
        }
    }
    if(empty($_POST["lastname"])){
        $errors["lasttname"]="Must Enter Your Last Name";
    }
    else{
        $Lname=data_input($_POST["lastname"]);
        filter_var($Lname,FILTER_SANITIZE_STRING);
        if(!ctype_alpha($Lname)){
            $errors["lastname"]="Only letters should be entered";
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
            $errors["email"]="Email Already In Use Please Enter Another Email Address";
            $Email='';
        }
        elseif(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
            $errors["email"]="Invalid Email Format Entered";
            $Email='';
        }
    }
    if(empty($_POST["password"])){
        $errors["password"]="Must Enter a Password";
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
    if(empty($fnError)&&empty($lnError)&&empty($pError)&&empty($emError)){
        wipeErrors();
        submit_info($conn);
        require("../forms/user-success.php");
    } else {
        // display form 
        storeErrors($errors);
        require("../forms/add-user.php");
    }
}

$data = json_decode(file_get_contents('php://input'), true);


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
    // echo "<meta http-equiv='refresh' content='0'>";
    // header("Location: ../index.php");
}
?>