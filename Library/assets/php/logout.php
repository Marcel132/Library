<?php
	
	// Create, delete session and go to main page
	session_start();
  	session_unset();
     
    header('Location: ../../index.html');

?>