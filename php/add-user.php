<?php
require("connection.php");
$basequery = "INSERT INTO users (firstname, lastname, password, email, date_joined)
                VALUES (:firstname, :lastname, :password, :email, :date_joined)";
$statement = $conn->prepare($basequery);
//$newquery="SELECT * from 'users'";
$Fname=$Lname=$Pass=$Email="";
$fnError=$lnError=$pError=$emError="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(empty($_POST["Fname"])){
    $fnError="Must Enter Your First Name";
  }
  else{
    $Fname=data_input($_POST["Fname"]);
    filter_var($Fname,FILTER_SANITIZE_STRING);
    if(!ctype_alpha($Fname)){
      $Fname='';
      $fnError="Only letters should be entered";
    }
  }
  if(empty($_POST["Lname"])){
    $lnError="Must Enter Your Last Name";
  }
  else{
    $Lname=data_input($_POST["Lname"]);
    filter_var($Lname,FILTER_SANITIZE_STRING);
    if(!ctype_alpha($Lname)){
      $lnError="Only letters should be entered";
      $Lname='';
    }
  }
  if(empty($_POST["Email"])){
    $emError="Must Enter Your Email";
  }
  else{
    $Email=data_input($_POST["Email"]);
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
  if(empty($_POST["Pass"])){
    $pError="Must Enter a Password";
  }
  else{
    $Pass=data_input($_POST["Pass"]);
    if(strlen($_POST["Pass"])<8){
      $pError="Password must have at least 8 characters and 1 Number and 1 Capital Letter";
      $Pass='';
    }
    elseif (!preg_match("#.*^(?=.{8,})(?=.*[A-Z])(?=.*[0-9]).*$#",$Pass)){
      $pError="Password must have at least 8 characters and 1 Number and 1 Capital Letter";
      $Pass='';
    }
 }
 if(empty($fnError)&&empty($lnError)&&empty($pError)&&empty($emError)){
   function submit_info($conn){
    global $statement;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = array_filter($_POST);
        $statement->bindParam(':firstname', $data["Fname"]);
        $current_date = date("Y-m-d");
        $pass_hash=md5($data['Pass']);
        $params = [
            ':firstname'        => $data['Fname'],
            ':lastname'  => $data['Lname'],
            ':password'         => $pass_hash,
            ':email'     => $data['Email'],
            ':date_joined'       => $current_date,
        ];
        $statement->execute($params);
        // echo "<meta http-equiv='refresh' content='0'>";
        header("Location: ../index.php");
    } else {
        alertError("Invalid request type");
    }
   }
   submit_info($conn);
 }
}
function data_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>New User</h1>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Firstname<br>
  <input type="text" name="Fname" value="<?php echo $Fname;?>">
  <span class="error">* <?php echo $fnError;?></span>
  <br><br>
  Lastname<br>
  <input type="text" name="Lname" value="<?php echo $Lname;?>">
  <span class="error">* <?php echo $lnError;?></span>
  <br><br>
  Password<br>
  <input type="password" name="Pass" value="<?php echo $Pass;?>">
 <span class="error">* <?php echo $pError;?></span>
 <br><br>
 Email<br>
 <input type="text" name="Email" value="<?php echo $Email;?>">
 <span class="error">* <?php echo $emError;?></span>
 <br><br>
 <input type="submit" name="submit" value="Submit">
</form>


</body>
</html>