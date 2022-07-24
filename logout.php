<?php  include "functions/init.php";?>


<?php
	
	session_destroy();
	unset($_SESSION['email']);
	unset($_SESSION['admin_mail']);
	

//check if we have a cookie
if(isset($_COOKIE['email'])){
	
	unset($_COOKIE['email']);
	
	setcookie('temp_access_code', '' , time()-900);
	
}


redirect("login.php");
	


?>