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
      <title>Customer Feedback Entry</title>
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

         
          function setSelectedGradeValueToHidden() {
             
             var objComboId = document.getElementById('grades');
             var comboText = objComboId.options[objComboId.options.selectedIndex].text;
             var comboValue = objComboId.options[objComboId.options.selectedIndex].value;
             var hiddenBoxObj = document.getElementById('grade');
             hiddenBoxObj.value=comboValue;
             
             
          }
     </script>
   </head>
   
   <body bgcolor = "#FFFFFF">
	       
           <form  onSubmit = "" action = "" method = "post">
             
           <div class="message"><?php if($message!="") { echo $message; } ?></div>
		    <table border="1" cellpadding="10" cellspacing="1" width="100%" align="center" >
       
			
            <tr>
            <td colspan=4 align="center" style="font-size:12px;">
                <select name="customers" id="customers" style=" width:400px;height:30px;" onchange="setSelectedCustToHidden()">
                <option value="" align="center" style="color:gray;">- - - - - - - - - - - - - -  select a customer who give feedback  - - - - - - - - -</option>
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
                <option value="" align="center" style="color:gray;">- - - - - - - - - - - - - -     select Item to be evaluated   - - - - - - - - - -</option>
                   <?php
                        $sql="SELECT itemcode,itemname FROM stock"; 
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
            <input type="hidden" name="grade" id="grade">
            <td align="right">
            <label>Date of Feedback<span class="mandatory">*</span> </label>
            </td>
            <td align="left">
			<input type="date" name="saledate"  required class="input_control">
            </td>
            <td align="right">
            Grade<span class="mandatory">*</span>
            </td>
            <td align="left">
            <select name="saletypes" required id="grades" style=" width:200px;height:30px;" onchange="setSelectedGradeValueToHidden()">
			        <option value="" align="center" style="color:gray;">- - - - Select Grade  - - - - </option>
                    <option value="A">Excellent</option>
                    <option value="B">Very Good</option>
                    <option value="C">Good</option>
                    <option value="D">Bad</option>           
            </select>
            </td>
            </tr>
            
            <tr>
            <td align="right">Opinion<span class="mandatory"></span>
            </td>
            <td align="left" colspan="3">
			<textarea id="openion" name="openion" rows="4" cols="100"> </textarea>
            </td>
            </tr>
            <tr class="tableheader">
			<td align="center" colspan="4"><input type="submit" name="Save" value="Save" class="btnSubmit"></td>
            </tr>
            <tr >
			<td align="center" colspan="4">List of Feedback Given </td>
            </tr>
            <tr>
               
                    <td colspan=4 align="center">
                    <table align= center border="1px" style="width:800px;line-height:20px">
                        <tr style="background:gray;color:white;"><td>customer Id</td><td>Item Code</td> <td>Item Name</td><td>Feedback.Date </td></tr>
                        <?php
                        $sql="SELECT f.cid, f.itemcode, s.itemname, f.grade, f.openion,f.fbkdate FROM feedback as f  inner join stock as s
                        on s.itemcode=f.itemcode "; 
                        $result = mysqli_query($conn,$sql);
                        
                        while( $rows = mysqli_fetch_assoc($result))
                        {
                        ?>
                        
                         <tr style="width:600px;line-height:25px;font-size:12px">
                             <td><?php echo $rows['cid']; ?> </td>
                             <td><?php echo $rows['itemcode']; ?> </td>
                             <td><?php echo $rows['itemname']; ?> </td>
                             <td><?php echo $rows['grade']; ?> </td>
                             <td><?php echo $rows['fbkdate']; ?> </td>
                             
                            
                        </tr>
                        
                        <?php
                        } 
                       
                       
                        ?>
                    </table>
                </td>
            </tr>
           
                    </table>
                </td>
            </tr>	
		</table>          
    </form>         
   </body>
</html>