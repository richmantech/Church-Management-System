<?php

 include "functions/init.php";

?>


<?php
$message = "";
if(request_is_post() && request_is_same_domain()) {

if(!csrf_token_is_valid() || !csrf_token_is_recent()) {
$message = "Sorry, request was not valid.";
}
else {
// CSRF tests passed--form was created by us recently.
// retrieve the values submitted via the form
$admin_email = h($_POST['admin_email']);
$admin_pass  = h($_POST['admin_pass']);
if(empty($admin_email)){
$message="Email cannot be empty";
}
if(empty($admin_pass)){
$message="Password cannot be empty";
}
else{

$stmt = mysqli_prepare($connections, "SELECT password, active FROM admin_users WHERE email = ? AND active = ?  ");
$active = 1;
mysqli_stmt_bind_param($stmt, "si", $admin_email,$active);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $password, $active);
mysqli_stmt_store_result($stmt);
if(mysqli_stmt_num_rows($stmt)== 1){
mysqli_stmt_fetch($stmt);

$db_password = $password;
if(password_verify($admin_pass, $db_password)){
$_SESSION['admin_mail'] = $admin_email;
redirect('index.php');
}else{
$message="Your Credentials Are Not Correct" ;	
}
}else{
$message= "Your Credentials Are Not Correct or activate your account";
}

}
}		
}
?>
<!DOCTYPE HTML>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Admin Login</title>

<link rel="stylesheet" href="includes/bootstrap.min.css" >

<link rel="stylesheet" href="includes/login.css" >

</head>

<body>

<div class="container" ><!-- container Starts -->

<form class="form-login" action="" method="post" ><!-- form-login Starts -->
<?php  display_message();  ?>
<?php
if($message != "") {
echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' ." ".  h($message) . '</div>';
}
?>
<?php echo csrf_token_tag(); ?>
<h2 class="form-login-heading" >Admin Login</h2>

<input type="text" class="form-control" name="admin_email" placeholder="Email Address" required >

<input type="password" class="form-control" name="admin_pass" placeholder="Password" required >

<button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login" >

Log in

</button>

<h4 class="forgot-password">

<a href="forgot_password.php">

Forgot Password

</a>

</h4>

</form><!-- form-login Ends -->

</div><!-- container Ends -->



</body>

</html>
