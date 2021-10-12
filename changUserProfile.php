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
<!DOCTYPE html>
<html>
   
   <head>
      <title>User Profile</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
      <link rel="shortcut icon" type="image/x-icon" href="image/logo.ico" />
      <script>
          
          // Function to check Whether both passwords
          // is same or not.
          function checkPassword(form) {
              password1 = form.password.value;
              password2 = form.Confirm_password.value;

                  
              if (password1 != password2) {
                  alert ("\nPassword did not match: Please try again...")
                  return false;
              }

              // If same return True.
              else{
                 
                  return true;
              }
          }
      </script>
   </head>
   
   <body bgcolor = "#FFFFFF">
	
       <table border="0" cellpadding="10" cellspacing="0" width="100%" hieght="00%" align="center" >

        <tr> 
           <td></>
           <td rowspan="8" colspan="3" style="font-size: 20px;  text-align: center;"> 
           <form  onSubmit = "return checkPassword(this)" action = "" method = "post">
             
           <div class="message"><?php if($message!="") { echo $message; } ?></div>
		    <table border="0" cellpadding="10" cellspacing="1" width="550" align="center" >
       
			<tr class="tableheader">
			<td align="center" colspan="2">Enter user account details</td>
			</tr>
			<tr class="tablerow">
           
			<td>
			<label ><span class="mandatory">*</span></label><input type="text" name="username" placeholder="User Name"  required class="input_control"></td>
			</tr>
            <tr class="tablerow">
            <td >
			<input type="text" name="fname" placeholder="First Name Required"  required class="input_control"></td>
			</tr>
            <tr class="tablerow">
            <td >
			<input type="text" name="lname" placeholder="Last Name Required"  required class="input_control"></td>
			</tr>
            <tr class="tablerow">
            <td >
			<input type="email" name="email" placeholder="Email Required"  multiple required class="input_control"></td>
			</tr>
			<tr class="tablerow">   
			<td >
			 <input type="password" name="password" placeholder="Password Required" required class="input_control"></td>
			</tr>
            <tr class="tablerow">   
			<td >
			 <input type="password" name="Confirm_password" placeholder="Confirm Password Required" required class="input_control"></td>
			</tr>
			
            <tr class="tableheader">
			<td align="center" colspan="2"><input type="submit" name="Save" value="Save" class="btnSubmit"></td>
            </tr>
            
			
		</table>
                 
    </form>

           </td>
        </tr>
         <tr>
           <td ><img src="image/healthy-groceries1.jpg" width="140" hieght="140"></td>
        </tr>
        <tr>
           <td ><img src="image/healthy-groceries2.jpg" width="140" hieght="140"></td>
        </tr>
        <tr>
        <td ><img src="image/healthy-groceries3.jpg" width="140" hieght="140"></td>
        </tr>
        <tr>
        <td ><img src="image/healthy-groceries4.jpg" width="140" hieght="140"></td>
        </tr>
        <tr>
        <td ><img src="image/healthy-groceries5.jpg" width="140" hieght="140"></td>
        </tr>
        <tr>
         <td ></td>
        </tr>
        <tr>
         <td ></td>
        </tr>
        <tr>
         <td colspan="4"> Address: 0000 Alta Vista Cape Girardeau MO 63701  Phone:+1573000000</td>

        </tr>
      </table>
			
                 
    
               
   </body>
</html>