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
   
   $restoredby= $logedusername;
   $SRDate=$_POST['SRdate'];
   $itemcode = $_POST['itemcode'];
   $RSQty = $_POST['rsqty'];
   
   
     $sql="INSERT INTO  restore_stock (itemcode,rsqty,SRdate, restoredby)
     VALUES('$itemcode','$RSQty','$SRDate', '$restoredby')";
      
     if(mysqli_query($conn,$sql))
     {
        
        //$sql="SELECT max(SRTrno) as SRTrno FROM restore_stock";
        //$result = mysqli_query($conn,$sql);
        //$transno = mysqli_fetch_object($result);
        
        
        if(mysqli_query($conn,$sql))
        {
           $sql="UPDATE stock  set stockbalance=stockbalance+$RSQty";
           if(mysqli_query($conn,$sql))
           {
            $message= "Stock Restor transaction inserted successfully.";
           }
           else
           {
            $message= "ERROR: Could not able to save Stock restore Transaction " . mysqli_error($conn);
           }
           
           
        }
        else
        {
            $message= "ERROR: Could not able to save Stock restore Transaction " . mysqli_error($conn);
        }
        
      
      } 
     else
      {
        $message= "ERROR: Could not able to save Stock restore Transaction "  . mysqli_error($conn);
      }
 
     //mysqli_close($conn);
     
}

?>

<!DOCTYPE html>
<html>
   
   <head>
      <title>Stock/Item Restore Transaction Entry</title>
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
     </script>
   </head>
   
   <body bgcolor = "#FFFFFF">
	       
           <form  onSubmit = "" action = "" method = "post">
             
           <div class="message"><?php if($message!="") { echo $message; } ?></div>
		    <table border="1" cellpadding="10" cellspacing="1" width="100%" align="center" >
       
			<tr class="tableheader">
			<td align="center" colspan="4">stock/Item Restoring Transaction Entry</td>
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
            <tr >
            
            <td align="right">
            <input type="hidden" name="itemcode" id="itemcode">
            <label>Date of Restore<span class="mandatory">*</span> </label>
            </td>
            <td align="left">
			<input type="date" name="SRdate"  required class="input_control">
            </td>
			</tr>
            <tr >
			<td align="right">Restoring Quantity<span class="mandatory">*</span>
            </td>
            <td align="left">
			<input type="text" name="rsqty"  required class="input_control">
            </td>
            <td colspan="2"></td>
			</tr>
            <tr class="tableheader">
			<td align="center" colspan="4"><input type="submit" name="Save" value="Save" class="btnSubmit"></td>
            </tr>
            <tr >
			<td align="center" colspan="4">Stock/Item Return Transaction List</td>
            </tr>
            <tr>
               
                    <td colspan=4 align="center">
                    <table align= center border="1px" style="width:800px;line-height:20px">
                        <tr style="background:gray;color:white;"><td>Transaction No.</td><td>Date Restord</td><td>Item Code</td> <td>Item Name</td><td>Qty. Restord</td></tr>
                        <?php
                        $sql="SELECT rg.SRTrno,rg.SRdate,s.itemcode, s.itemname, rg.rsqty FROM mystoredb.stock as s inner join 
                        mystoredb.restore_stock as rg on s.itemcode=rg.itemcode "; 
                        $result = mysqli_query($conn,$sql);
                         while( $rows = mysqli_fetch_assoc($result))
                         {
                        ?>
                        
                         <tr style="width:600px;line-height:25px;font-size:12px">
                             <td><?php echo $rows['SRTrno']; ?> </td>
                             <td><?php echo $rows['SRdate']; ?> </td>
                             <td><?php echo $rows['itemcode']; ?> </td>
                             <td><?php echo $rows['itemname']; ?> </td>
                             <td><?php echo $rows['rsqty']; ?> </td>
                            
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