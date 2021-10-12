<?php
 $message="";
 $logedusername;
 $trnsactStatus;
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
   
   $Receivedby= $logedusername;
   $pono=$_POST['pono'];
   $cid=$_POST['cid'];
   $podate=$_POST['podate'];
   $contactperson = $_POST['contactperson'];
   $itemcode = $_POST['itemcode'];
   $qtyordered = $_POST['qtyordered'];
  
  
   
     $sql="INSERT INTO  purchase_order (cid,pono,podate,contactperson, POreceivedby,itemcode,qtyordered)
     VALUES('$cid','$pono','$podate','$contactperson', '$Receivedby','$itemcode','$qtyordered')";
      
     if(mysqli_query($conn,$sql))
     {
           
        $message= "Purchase Order transaction inserted successfully.";
           
      
      } 
     else
      {
        $message= "ERROR: Could not able to save Purchase Order Transaction "  . mysqli_error($conn);
      }
 
     //mysqli_close($conn);
     
}

?>

<!DOCTYPE html>
<html>
   
   <head>
      <title>Purchase Order Entry</title>
      <link rel="stylesheet" type="text/css" href="styles.css" />
      <link rel="shortcut icon" type="image/x-icon" href="image/logo.ico" />
      <script>
       
         function setSelectedValueToHidden() {
             
           var objComboId = document.getElementById('items');
           var comboText = objComboId.options[objComboId.options.selectedIndex].text;
           var comboValue = objComboId.options[objComboId.options.selectedIndex].value;
           var textBoxObj = document.getElementById('itemname');
           var hiddenBoxObj = document.getElementById('itemcode');
           hiddenBoxObj.value=comboValue;
           
        }
        function setSelectedCustToHidden() {
             
             var objComboId = document.getElementById('customers');
             var comboText = objComboId.options[objComboId.options.selectedIndex].text;
             var comboValue = objComboId.options[objComboId.options.selectedIndex].value;
             var textBoxObj = document.getElementById('lname');
             var hiddenBoxObj = document.getElementById('cid');
             hiddenBoxObj.value=comboValue;
             
             
          }
     </script>
   </head>
   
   <body bgcolor = "#FFFFFF">
	       
           <form  onSubmit = "" action = "" method = "post">
             
           <div class="message"><?php if($message!="") { echo $message; } ?></div>
		    <table border="1" cellpadding="10" cellspacing="1" width="100%" align="center" >
       
			<tr class="tableheader">
			<td align="center" colspan="4">Purchase Order Transaction Entry</td>
			</tr>
            <tr>
            <td colspan=4 align="center" style="font-size:12px;">
                <select name="customers" id="customers" style=" width:400px;height:30px;" onchange="setSelectedCustToHidden()">
                <option value="" align="center" style="color:gray;">- - - - - - -   select the customer who order purchase  - - - - - - -</option>
                   <?php
                        $sql="SELECT cid, lname  FROM customer"; 
                        $result = mysqli_query($conn,$sql);
                         while( $rows = mysqli_fetch_assoc($result))
                         {
                    ?>
                          <option value="<?php echo $rows['cid']; ?>"><?php echo $rows['lname']; ?></option>
                        
                        <?php 
                        }
                       
                        ?>
                        </select>
                        </td>     
            </tr>
			<tr>
            <td colspan=4 align="center" style="font-size:12px;">
                <select name="items" id="items" style=" width:400px;height:30px;" onchange="setSelectedValueToHidden()">
                <option value="" align="center" style="color:gray;">- - - - - - - - - -    select Item to be restored   - - - - - - - - - -</option>
                   <?php
                        $sql="SELECT itemcode, itemname, unitprice, stockbalance FROM stock"; 
                        $result = mysqli_query($conn,$sql);
                         while( $rows = mysqli_fetch_assoc($result))
                         {
                    ?>
                          <option value="<?php echo $rows['itemcode']; ?>"><?php echo $rows['itemname']; ?></option>
                        
                        <?php 
                        }
                         
                        ?>
                        </select>
                        </td>     
            </tr>
           <tr>
            <input type="hidden" name="cid" id="cid">
            <input type="hidden" name="itemcode" id="itemcode">
			<td align="right">PO.No.<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="pono"  required class="input_control">
            </td>
            <td align="right">
            <label>Date of Purchase Order<span class="mandatory">*</span> </label>
            </td>
            <td align="left">
			<input type="date" name="podate"  required class="input_control">
            </td>
            </tr>
            <tr>
            <td align="right">Quantity Ordered.<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="qtyordered"  required class="input_control">
            </td>
            <td align="right">Contact Person<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="contactperson"  required class="input_control">
            </td>
			</tr>
            
            <tr class="tableheader">
			<td align="center" colspan="4"><input type="submit" name="Save" value="Save" class="btnSubmit"></td>
            </tr>
            <tr >
			<td align="center" colspan="4">Purchase Order Transaction List</td>
            </tr>
            <tr>
               
                    <td colspan=4 align="center">
                    <table align= center border="1px" style="width:800px;line-height:20px">
                        <tr style="background:gray;color:white;"><td>PO.No.</td><td>PO.Date </td><td>Item Code</td> <td>Item Name</td><td>Qty. Ordered</td></tr>
                        <?php
                        $sql="SELECT p.POTrno,p.pono,p.podate,s.itemcode, s.itemname, p.qtyordered FROM mystoredb.stock as s inner join 
                        mystoredb.purchase_order as p on s.itemcode=p.itemcode "; 
                        $result = mysqli_query($conn,$sql);
                         while( $rows = mysqli_fetch_assoc($result))
                         {
                        ?>
                        
                         <tr style="width:600px;line-height:25px;font-size:12px">
                             <td><?php echo $rows['pono']; ?> </td>
                             <td><?php echo $rows['podate']; ?> </td>
                             <td><?php echo $rows['itemcode']; ?> </td>
                             <td><?php echo $rows['itemname']; ?> </td>
                             <td><?php echo $rows['qtyordered']; ?> </td>
                           
                        </tr>
                        
                        <?php 
                        }
                         
                        ?>
                    </table>
                </td>
            </tr>
            <td align="center" colspan="4">Items in Stock Detail List</td>
            </tr	
            <tr>
               
                    <td colspan=4 align="center">
                    <table align= center border="1px" style="width:800px;line-height:20px">
                        <tr style="background:gray;color:white;"><td>Item Code</td><td>Name</td><td>Stock Balance</td></tr>
                        <?php
                        $sql="SELECT itemcode, itemname, unitprice, stockbalance FROM stock"; 
                        $result = mysqli_query($conn,$sql);
                         while( $rows = mysqli_fetch_assoc($result))
                         {
                        ?>
                        
                         <tr style="width:600px;line-height:25px;font-size:12px">
                             <td><?php echo $rows['itemcode']; ?> </td>
                             <td><?php echo $rows['itemname']; ?> </td>
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