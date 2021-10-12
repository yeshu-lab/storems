<?php
 
$message="";

session_destroy(); 
$message = "You are Loged out successfully";       
header("location: index.php?message= $message");
          
   

?>