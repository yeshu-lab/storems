<?php
 $message="";
 $logedusername;
 //check if user authenticated and properly loged in  
session_start();
if(!isset($_SESSION['login_user']))
{
    
    header("location: login.php");
}
  
else
{
    
    $logedusername = $_SESSION['login_user'];
}
 include("dbcon.php");
if(count($_POST)>0)
{
   $fname = $_POST['fname'];
   $mint = $_POST['mint'];
   $lname = $_POST['lname'];
   $phone = $_POST['phone'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $state = $_POST['state'];
   $city = $_POST['city'];
   $zipcode = $_POST['zipcode'];
   
   
      
     $sql="INSERT INTO customer (fname, mint, lname, phone, email, address, state, city, zipcode)
     VALUES('$fname', '$mint', '$lname', '$phone', '$email', '$address', '$state', '$city', '$zipcode')";
      
     if(mysqli_query($conn,$sql))
     {
        $message= "Customer Record inserted successfully.";
      } 
     else
      {
        $message= "ERROR: Could not able to save customer record " . mysqli_error($conn);
      }
 
     //mysqli_close($conn);
     
}
?>


<!DOCTYPE html>
<html>
   
   <head>
      <title>Customer</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
      <link rel="shortcut icon" type="image/x-icon" href="image/logo.ico" />
    
   </head>
   
   <body bgcolor = "#FFFFFF">
	       
           <form  onSubmit = "" action = "" method = "post">
             
           <div class="message"><?php if($message!="") { echo $message; } ?></div>
		    <table border="1" cellpadding="10" cellspacing="1" width="100%" align="center" >
       
			<tr class="tableheader">
			<td align="center" colspan="4">Enter Customer Details</td>
			</tr>
			
            <tr style="line-height:15px;font-size:12">
            <td align="right">
                First Name<span class="mandatory">*</span>
            </td>
            <td align="left">
			 <input type="text" name="fname"   required class="input_control">
            </td>
            <td align="right">
                Middle Name Int<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="mint"  required class="input_control">
            </td>
			</tr>
            <tr >
			<td align="right">Last Name<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="lname"  required class="input_control">
            </td>
            <td align="right">Phone Number<span class="mandatory">*</span>
            </td>
			<td align="left">
			 <input type="text" name="phone"  required class="input_control">
            </td>
			</tr>
           
            
            <tr >
            <td align="right">Email<span class="mandatory">*</span></td>
            <td align="left">
			<input type="email" name="email"   multiple required class="input_control">
            </td>
            <td align="right">Address<span class="mandatory">*</span></td>  
			<td align="left">
			<input type="text" name="address"  required class="input_control">
            </td>
			</tr>
			
            <tr >  
            <td align="right">State<span class="mandatory">*</span></td> 
            <td align="left">
			<input type="text" name="state"  required class="input_control">
             </td>
             <td align="right">City<span class="mandatory">*</span></td>  
			<td align="left">
			<input type="text" name="city"  required class="input_control">
            </td>
			</tr>
            
			<tr>
            <td align="right">Zip Code<span class="mandatory">*</span></td>   
			<td align="left">
			<input type="text" name="zipcode" required class="input_control">
            </td>
            <td colspan="2"></td>
			</tr>
            <tr class="tableheader">
			<td align="center" colspan="4"><input type="submit" name="Save" value="Save" class="btnSubmit"></td>
            </tr>
            <tr>
                <td colspan=6 align="center" style="width:800px;font-size:12px">
                
                    <table align= center border="1px" style="width:800px;line-height:20px">
                        <tr style="background:gray;color:white;"><td>Customer Id</td><td>Fame</td><td>Mint</td><td>Lname</td>
                          <td>Phone</td> <td>Email</td><td>Address</td> <td>State</td><td>City</td><td>Zip Code</td>
                        </tr>
                        <?php
                        $sql="SELECT * FROM customer"; 
                        $result = mysqli_query($conn,$sql);
                         while( $rows = mysqli_fetch_assoc($result))
                         {
                        ?>
                         <tr style="width:800px;line-height:25px;font-size:12px">
                             <td><?php echo $rows['cid']; ?> </td>
                             <td><?php echo $rows['fname']; ?> </td>
                             <td><?php echo $rows['mint']; ?> </td>
                             <td><?php echo $rows['lname']; ?> </td>
                             <td><?php echo $rows['phone']; ?> </td>
                             <td><?php echo $rows['email']; ?> </td>
                             <td><?php echo $rows['address']; ?> </td>
                             <td><?php echo $rows['state']; ?> </td>
                             <td><?php echo $rows['city']; ?> </td>
                             <td><?php echo $rows['zipcode']; ?> </td>
                        </tr>
                        
                        <?php 
                        }
                        $count = mysqli_num_rows($result); 
                        ?>
                    </table>
                </td>
            </tr>		
		</table>          
    </form>         
   </body>
</html>