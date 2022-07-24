<?php

// Escapes a string to render it safe for SQL.

function sql_prep($string) {
	global $connections;
	if($connections) {
		return mysqli_real_escape_string($connections, $string);
	} else {
		
		// Fallback only when there is no database connection available.
	 	return addslashes($string);
	}
}



?>
