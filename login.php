<?php
 
$message="";
if(count($_POST)>0)
{
   include("dbcon.php");
   
   $myusername = $_POST['username'];
   $mypassword = $_POST['password'];
   
     $sql = "SELECT userid FROM user WHERE username = '$myusername' and password = '$mypassword'";
      
     $result = mysqli_query($conn,$sql);
      
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
      if($count == 1) {
        session_start();
         $_SESSION['login_user'] = $myusername;
         header("location: dashboard.php");
      }else {
         $message = "Your Login Name or Password is invalid. Please try again!";
      }
      
    mysqli_close($conn);
}
?>
<html>
   
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
      <link rel="shortcut icon" type="image/x-icon" href="image/logo.ico" />
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
    <form action = "" method = "post">
           <img src="image/logo.png" width="100" hieght="100">  
        <div class="message"><?php if($message!="") { echo $message; } ?></div>
		<table border="0" cellpadding="10" cellspacing="1" width="550" align="center" class="tblLogin">
           
			<tr class="tableheader">
			<td align="center" colspan="2">Enter Login Details</td>
			</tr>
			<tr align="center" >
           
			<td>
			<label >User Name<span class="mandatory">*</span></label><input type="text" name="username" placeholder="User Name"  required class="input_control"></td>
			</tr>
			<tr  align="center">
               
			<td >
			<label>Password<span class="mandatory">*</span></label><input type="password" name="password" placeholder="Password" required class="input_control"></td>
			</tr>
			
            <tr class="tableheader">
			<td align="center" colspan="2"><input type="submit" name="submit" value="Login" class="btnSubmit"></td>
            </tr>
            <tr>
            <td ><a href="user.php">New user? Create an Anccount</a></td>
			</tr>
            
			
		</table>
                 
    </form>
               
   </body>
</html>