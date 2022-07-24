<?php ob_start(); //for redirection

session_start();
header("X-Frame-Options: sameorigin");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
header("Strict-Transport-Security: max-age=31536000");

include("db.php");
include("functions.php");

require_once("validation_functions.php");
require_once("xss_sanitize_functions.php");
require_once("sqli_escape_functions.php");
require_once("csrf_request_type_functions.php");
require_once("csrf_token_functions.php");
require_once("request_forgery_functions.php");
require_once("reset_token_functions.php");
require_once("session_hijacking_functions.php");
require_once("throttle_functions.php");
?>




