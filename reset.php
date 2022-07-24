<?php

 include "functions/init.php";

?>
<!DOCTYPE HTML>
<html>

<head>

<title>Admin Reset Password</title>

<link rel="stylesheet" href="includes/bootstrap.min.css" >

<link rel="stylesheet" href="includes/login.css" >

</head>

<body>

<div class="container" ><!-- container Starts -->

<form class="form-login" action="" method="post" ><!-- form-login Starts -->
<?php display_message(); ?>
            <?php password_reset() ?>
<?php echo csrf_token_tag(); ?>
<h2 class="form-login-heading" >Admin Reset Password</h2>

<input type="password" class="form-control" name="password" placeholder="New Password" required >

<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required >

<button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login" >

Change Password

</button>
 <input type="hidden" class="hide" name="token" id="token" value="<?php echo token_generator(); ?>">


</form><!-- form-login Ends -->

</div><!-- container Ends -->



</body>

</html>
