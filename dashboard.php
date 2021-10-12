<?php
 
 $logedusername="";
 

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
  
?>
<html>
   
   <head>
      <title>Dashboard</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
      <link rel="shortcut icon" type="image/x-icon" href="image/logo.ico" />
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
       <table border="1" cellpadding="0" cellspacing="0" width="100%" hieght="100%" align="center" >

       <tr >
           <td colspan="4" class = "welcome" height="140">
            
           </td>
          
           
        </tr>
       
        <tr>
           
           <td style="text-align: center;border: 0em;" colspan="1"><img src="image/logo.png" width="130" hieght="130"></td>
           <td style="text-align: center; font-size: 18; font-weight:bold;border: 0em;" colspan="2">Yeshi Healthy Food Store </td>
           <td style="text-align: center;border: 0em;">
           <form action = "logout.php" method = "post"><input type="submit" name="submit" value="Logout" >
           </form>
           <label style="color:gray;font-size:12;"><?php if($logedusername!=""){echo "You loged as ".$logedusername;}?></label> 
           </td>
          
       </tr>
       
        <tr> 
           <td colspan="1" rowspan="8" id="menu">
           <div >
      <ul>
        
        <li><a href="sale.php" target="dashbord">Sale Transaction</a></li>
        <li><a href="purchaseorder.php" target="dashbord">Purchase Order</a></li>
        <li><a href="stock.php" target="dashbord">New Stock Entry</a></li>
        <li><a href="itemrestore.php" target="dashbord">Stock Restore</a></li>
        <li><a href="Customer.php" target="dashbord">Customer Data Entry</a></li>
        <li><a href="feedback.php" target="dashbord">Customer Feedback</a></li>
        <li><a href="user.php" target="dashbord">User Profile</a></li>
        <li><a href="cashinvoice.php" >Report</a></li>
       
        
      </ul>
    </div>
           </td>
           <td rowspan="6" colspan="3" style="font-size: 20px;  text-align: center;"> 
          
		    <iframe src="defaultpage.html" width="1000" height="1050" style="border:none;" name="dashbord">
            </iframe>
    
           </td>
        </tr>
        
      </table>
			            
   </body>
</html>