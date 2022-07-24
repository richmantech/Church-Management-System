<?php

include "functions/init.php";


?>
<!DOCTYPE HTML>
<html>

<head>

<title>Admin Forgot Password </title>

<link rel="stylesheet" href="includes/bootstrap.min.css" >

<link rel="stylesheet" href="includes/login.css" >

<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" >

</head>

<body>

<div class="container" ><!-- container Starts -->

<div class="alert alert-info">

<strong> Info </strong> Please enter your email address. You will receive a link to create a new password via email.

</div>

<form class="form-login" action="" method="post" ><!-- form-login Starts -->
<?php display_message(); ?>
<?php recover_password(); ?>
<h2 class="form-login-heading" > Forgot Password </h2>

<input type="text" class="form-control" name="email" placeholder="Email Address" required >

<button class="btn btn-lg btn-primary btn-block" type="submit" name="forgot_password" >

Send Email

</button>
<input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator(); ?>">
<h4 class="forgot-password">

<a href="login.php">

<i class="fa fa-arrow-left"></i> Back To Login Page

</a>

</h4>

</form><!-- form-login Ends -->

</div><!-- container Ends -->



</body>

</html>

