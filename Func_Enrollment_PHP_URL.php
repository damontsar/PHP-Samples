<?php 
// //////////////////////////////////////////////////////////////////////////

function Enrollment_PHP_URL ($Matrix_OutputArray) {
extract($Matrix_OutputArray);
$PHP_MYStamp = date("_m-Y", time());
$device_AssessMenMap = $EA47_PHP_Tag_JAMF_Assessment_PHP . " " . $PHP_MYStamp;
// $EA05_CCSD_Domain_Login_Suffix_PHP = "@charleston.k12.sc.us"; 	// set here your ldap domain
$ldapPort = "389"; // ldap Port (default 389)
$CCSD_Ldap_Server_PHP = 'charleston.k12.sc.us'; 	// set here your ldap host
$DomainName_Enroll = ""; // ldap User (rdn or dn)
$DomainPass_Enroll = ""; 	// ldap associated Password  
$successMessage = "";
$errorMessage = "";
$MessageTop1 = 'Welcome to CCSD';
$MessageTop2 = 'Please sign on to the Device.';
$MessageTop3 = $device_AssessMenMap;
    
$MessageBottom1a = 'Locale Device IP Address:';
$MessageBottom1b = $EA19_PHP_Device_IP_PHP;
$MessageBottom2a = 'Device_SN:';
$MessageBottom2b = $MobileGeneral_Serial_Number;
$MessageBottom3a = 'Jamf_ID:';
$MessageBottom3b = $MobileGeneral_Id;
$MessageBottom4a = 'Device User State:';
$MessageBottom4b = $EA26_DeviceState_Based_On_User_Jss;
// connect to ldap server

$Ldap_Connection = ldap_connect($CCSD_Ldap_Server_PHP, $ldapPort) or die('Could not connect to Ldap server.');


if (isset($_POST["btnSubmit"])) {
if ($Ldap_Connection) {
    
if (isset($_POST["UserName_PHP"]) && $_POST["UserName_PHP"] != "")
{
	$DomainName_Enroll = addslashes(trim($_POST["UserName_PHP"]));
    $DomainName_Enroll = strtoupper($DomainName_Enroll);
}
else {
    $errorMessage = "Invalid User value!!"; 
    Enrollment_PHP_UserError_URL ($Matrix_OutputArray, $errorMessage);
   

}

if (isset($_POST["UserPass_PHP"]) && $_POST["UserPass_PHP"] != "")
{
    $DomainPass_Enroll = addslashes(trim($_POST["UserPass_PHP"]));
}
else {
    $errorMessage = "Invalid Password value!!";
    Enrollment_PHP_UserError_URL ($Matrix_OutputArray, $errorMessage);

}

if ($errorMessage == "") {
Ldap_Accpt($Ldap_Connection, $DomainName_Enroll, $DomainPass_Enroll, $Matrix_OutputArray); exit;
//ThankYou_URL ($DomainName_Enroll, __LINE__); 

} 
else 
{// error message
// header("Location:./register.php?UDID=".$EA51_DeviceUDID_PHP."&msg=Incorrect%20username%20or%20password.");
    $errorMessage = "Invalid Ldap connection!!"; 
    Error_URL ($errorMessage, __LINE__); 
} // end LDAP section
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
<?php		
if ($errorMessage != "") echo "<h3 style='color:blue;'>$errorMessage</h3>";
if ($successMessage != "") echo "<h3 style='color:blue;'>$successMessage</h3>";
?> 
<meta charset="utf-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>iPad_Enrollment_Page</title>
<link rel="stylesheet" href="./css/all.ccsd.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@481;768;1024&display=swap">
<!--Stylesheet-->
<style media="screen">
  *,
*:before,
*:after{
padding: 0;
margin: 0;
box-sizing: border-box;
}
body{
width: 100vw;
height: 100vh;
background-image: url("./assets/img/Pineapple.jpg");
background-repeat: no-repeat;
background-size: cover;
background-position: center;
}
form{
height: 500px;
width: 400px;
background-color: #080710;
position: absolute;
transform: translate(-50%,-50%);
top: 45%;
left: 30%;
border-radius: 10px;
backdrop-filter: blur(10px);
border: 2px solid rgba(255,255,255,0.1);
box-shadow: 0 0 40px rgba(8,7,16,0.6);
padding: 20px 20px;
}
form *{
font-family: 'Poppins',sans-serif;
color: #ffffff;
letter-spacing: 0.5px;
outline: none;
border: none;
}
form h3{
font-size: 22px;
font-weight: 500;
line-height: 40px;
text-align: center;
}
form h4{
text-align: center;
}
label{
display: block;
margin-top: 30px;
font-size: 16px;
font-weight: 500;
}
input{
display: block;
height: 50px;
width: 100%;
background-color: rgba(255,255,255,0.07);
border-radius: 3px;
padding: 0 10px;
margin-top: 8px;
font-size: 14px;
font-weight: 300;
}
::placeholder{
color: #e5e5e5;
}
button{
margin-top: 50px;
width: 100%;
background-color: #ffffff;
color: #080710;
padding: 15px 0;
font-size: 18px;
font-weight: 600;
border-radius: 5px;
cursor: pointer;
}
/* Header/logo Title */
.formheader{
height: 60px;
width: 800px;
background-image: url("./assets/img/CCSD.png");
background-repeat: no-repeat;
background-size: auto;
background-position: center;
position: absolute;
transform: translate(-50%,-50%);
top: 87%;
left: 50%;
border-radius: 5px;
backdrop-filter: blur(5px);
border: 2px solid rgba(255,255,255,0.1);
box-shadow: 0 0 40px rgba(8,7,16,0.6);
padding: 10px 10 px;
}
.formdata {
display: flex;
height: 60px;
width: 800px;
background-color: #080710;
position: absolute;
transform: translate(-50%,-50%);
bottom: 5px;
left: 50%;
border-radius: 5px;
border: 2px solid rgba(255,255,255,0.1);
box-shadow: 0 0 5px rgba(8,7,16,0.6);
padding: 2px 2px;

}
.formdata *{
font-family: 'Poppins',sans-serif;
color: #ffffff;
letter-spacing: 0.5px;
outline: none;
border: none;
}
.formdata h3{
font-size: 22px;
font-weight: 500;
line-height: 40px;
text-align: center;
}
.formdata h4{
text-align: center;
}
/* Create two equal columns that sits next to each other */
.column1 {
  flex: 30%;
  padding: 1px;
}
.column2 {
  flex: 25%;
  padding: 1px;
}

</style>
</head>
<body>
<div class="background"></div>
<div class="formheader"></div>
<form action="" method="post" name="form" class="form form-horizontal">
<h3><?=$MessageTop1?></h3>
<h3><?=$MessageTop2?></h3>
<h4><p><?=$MessageTop3?></p></h4>

<label for="username">Username<span title="This field is required" class="required">*</span></label>
<input type="text" value="" class="form-control" required="required" name="UserName_PHP" id="form_username">

<label for="password">Password<span title="This field is required" class="required">*</span></label>
<input type="password" value="" class="form-control" required="required" name="UserPass_PHP" id="form_password">

<button class="btn btn-default" name="btnSubmit" type="submit">Submit</button>
<h3> </h3>
</form>
<div class="formdata">
<div class="column1"><h4><?=$MessageBottom1a?><p><?=$MessageBottom1b?></p></h4></div>
<div class="column2"><h4><?=$MessageBottom2a?><p><?=$MessageBottom2b?></p></h4></div>
<div class="column2"><h4><?=$MessageBottom3a?><p><?=$MessageBottom3b?></p></h4></div>
<div class="column2"><h4><?=$MessageBottom4a?><p><?=$MessageBottom4b?></p></h4></div>
</div>
</body>
</html>
<?php

};


// //////////////////////////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////////

?>