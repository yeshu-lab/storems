<?php
 
$message="";

if(count($_POST)>0)
{
   include("dbcon.php");
      $username = $_POST['username'];
      $sql = "SELECT userid FROM user WHERE username = '$username'";
      $result = mysqli_query($conn,$sql); 
      $count = mysqli_num_rows($result);
      
      if($count == 0) 
      {
        $username = $_POST['username'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
       
        $email = $_POST['email'];
        $sql = "INSERT INTO user (username, fname, lname,email, password) VALUES ('$username', '$fname', '$lname','$email', ' $password')";

        if (mysqli_query($conn, $sql))
         {
            $message="New user created successfully! Now you can login.";
            
            
         } 
         else 
         {
           $message= "Error: account creation failed: ". mysqli_error($conn);
            
         
        }
    }
    else 
      {
        $message = "This User is already exists.Please try an other user name.";
      }
      
  mysqli_close($conn);
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

       <tr >
           <td colspan="4" class = "welcome" height="140">
            
           </td>
          
           
        </tr>
       
        <tr>
           
           <td style="text-align: center;" colspan="2"><img src="image/logo.png" width="100" hieght="100"></td>
           <td colspan=2><a href="login.php">Login</td>
          
       </tr>
       <tr>
           
           <td style="text-align: center; font-size: 18; font-weight:bold;" colspan="4">Yeshi Healthy Food Store</td>
           
          
       </tr>
          
        <tr> 
           <td></>
           <td rowspan="8" colspan="3" style="font-size: 20px;  text-align: center;"> 
           <form  onSubmit = "return checkPassword(this)" action = "" method = "post">
             
           <div class="message"><?php if($message!="") { echo $message; } ?></div>
		    <table border="0" cellpadding="10" cellspacing="1" width="550" align="center" >
       
			<tr class="tableheader">
			<td align="center" colspan="2">Enter user account details</td>
			</tr>
			<tr align="center">
           
			<td>
			<label >User Name<span class="mandatory">*</span></label><input type="text" name="username" placeholder=""  required class="input_control"></td>
			</tr>
            <tr align="center">
            <td >
			<label >First Name<span class="mandatory">*</span></label><input type="text" name="fname" placeholder=""  required class="input_control"></td>
			</tr>
            <tr align="center">
            <td >
			<label >Last Name <span class="mandatory">*</span></label><input type="text" name="lname" placeholder=""  required class="input_control"></td>
			</tr>
            <tr align="center">
            <td >
			<label >Email<span class="mandatory">*</span></label><input type="email" name="email" placeholder=""  multiple required class="input_control"></td>
			</tr>
			<tr align="center">   
			<td >
			<label>Password<span class="mandatory">*</span></label><input type="password" name="password" placeholder="" required class="input_control"></td>
			</tr>
            <tr align="center">   
			<td >
			<label>Confirm Password<span class="mandatory">*</span></label><input type="password" name="Confirm_password" placeholder="" required class="input_control"></td>
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