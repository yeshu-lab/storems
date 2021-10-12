<?php
 
$message="";
//if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
if(count($_POST)>0)
{
   include("dbcon.php");
   session_start();
   $myusername = $_POST['username'];
   $mypassword = $_POST['password'];
   
      $sql = "SELECT userid FROM user WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
     
     // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      if($count == 0) 
      {
        $username = $_POST['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $password = $_POST['password'];
       
        $sql = "INSERT INTO user (username, fname, lname, password) VALUES ('$username', '$fname', '$lname', ' $password')";

        if (mysqli_query($conn, $sql))
         {
            $message="New user created successfully! Now you can login.";
            header("location: index.php?created=$message");
            
         } 
         else 
         {
            $message= "Error: account creation failed ";
         
        }
    }
    else 
      {
        $message = "User already exist.Try again";
      }
}
?>
<html>
   
   <head>
      <title>User Account Detail</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
    <form action = "" method = "post">
             
        <div class="message"><?php if($message!="") { echo $message; } ?></div>
		<table border="0" cellpadding="10" cellspacing="1" width="550" align="center" >
       
			<tr class="tableheader">
			<td align="center" colspan="2">Enter user account details</td>
			</tr>
			<tr class="tablerow">
           
			<td>
			<label >User Name<span class="mandatory">*</span></label><input type="text" name="username" placeholder="User Name"  required class="login-input"></td>
			</tr>
            <tr class="tablerow">
            <td >
			<label >First Name<span class="mandatory">*</span></label><input type="text" name="fname" placeholder="First Name"  required class="login-input"></td>
			</tr>
            <tr class="tablerow">
            <td >
			<label >Last Name<span class="mandatory">*</span></label><input type="text" name="lname" placeholder="Last Name"  required class="login-input"></td>
			</tr>
			<tr class="tablerow">   
			<td >
			<label>Password<span class="mandatory">*</span></label><input type="password" name="password" placeholder="Password" required class="login-input"></td>
			</tr>
			
            <tr class="tableheader">
			<td align="center" colspan="2"><input type="submit" name="Create" value="create" class="btnSubmit"></td>
            </tr>
            
			
		</table>
                 
    </form>
               
   </body>
</html>