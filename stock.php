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
   
   
   $itemname = $_POST['itemname'];
   $unitprice = $_POST['unitprice'];
   $stockbalance = $_POST['stockbalance'];
   
     $sql="INSERT INTO  stock (itemname, unitprice, stockbalance)
     VALUES('$itemname', '$unitprice', '$stockbalance')";
      
     if(mysqli_query($conn,$sql))
     {
        $message= "Stock/Item restore transaction record inserted successfully.";
      } 
     else
      {
        $message= "ERROR: Could not able to save Stock/Item restore transaction record " . mysqli_error($conn);
      }
 
     //mysqli_close($conn);
     
}

?>


<!DOCTYPE html>
<html>
   
   <head>
      <title>New Stock/Item Entry</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
      <link rel="shortcut icon" type="image/x-icon" href="image/logo.ico" />
    
   </head>
   
   <body bgcolor = "#FFFFFF">
	
       
           
           <form  onSubmit = "" action = "" method = "post">
             
           <div class="message"><?php if($message!="") { echo $message; } ?></div>
		    <table border="1" cellpadding="10" cellspacing="1" width="100%" align="center" >
       
			<tr class="tableheader">
			<td align="center" colspan="4">New Item Details Recording</td>
			</tr>
			
            <tr >
            <td align="right">
            Item Name<span class="mandatory">*</span>
            </td>
            <td align="left">
			 <input type="text" name="itemname"   required class="input_control">
            </td>
            <td align="right">
            unit Urice<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="unitprice"  required class="input_control">
            </td>
			</tr>
            <tr >
			<td align="right">Quantity<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="stockbalance"  required class="input_control">
            </td>
            <td colspan="2"></td>
			</tr>
            <tr class="tableheader">
			<td align="center" colspan="4"><input type="submit" name="Save" value="Save" class="btnSubmit"></td>
            </tr>
            <tr>
                <td colspan=4 align="center" style="font-size:12px;">
                
                    <table align= center border="1px" style="width:800px;line-height:20px">
                        <tr style="background:gray;color:white;"><td>Item Code</td><td>Name</td><td>unit Price</td><td>Qty.</td></tr>
                        <?php
                        $sql="SELECT itemcode, itemname, unitprice, stockbalance FROM stock"; 
                        $result = mysqli_query($conn,$sql);
                         while( $rows = mysqli_fetch_assoc($result))
                         {
                        ?>
                         <tr style="width:600px;line-height:25px;font-size:12px">
                             <td><?php echo $rows['itemcode']; ?> </td>
                             <td><?php echo $rows['itemname']; ?> </td>
                             <td><?php echo $rows['unitprice']; ?> </td>
                             <td><?php echo $rows['stockbalance']; ?> </td>
                        </tr>
                        
                        <?php 
                        }
                        mysqli_close($conn); 
                        ?>
                    </table>
                </td>
            </tr>	
		</table>          
    </form>         
   </body>
</html>