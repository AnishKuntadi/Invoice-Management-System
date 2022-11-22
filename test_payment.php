<?php  
 //test_class.php  
  include 'database.php';
  include "includes/header.php";
  include "includes/footer.php";
 
  $data = new DB_Con();  
  $success_message = '';  
  if(isset($_POST["edit"]))  
  {  
      $update_data = array(  
           'invoice_id'         =>     mysqli_real_escape_string($data->con, $_POST['invoice_id']),  
           'client_name'        =>     mysqli_real_escape_string($data->con, $_POST['client_name']),
           'payment_type'       =>     mysqli_real_escape_string($data->con, $_POST['payment_type']),
           'paid_date'          =>     mysqli_real_escape_string($data->con, $_POST['paid_date']),
           'paid_amount'       =>     mysqli_real_escape_string($data->con, $_POST['paid_amount'])
      );  
      $where_condition = array(  
           'id'     =>     $_POST["id"]  
      );  
      if($data->update("payment", $update_data, $where_condition))  
      {  
           header("location:payment.php?updated=1");  
      }  
 }  
 if(isset($_GET["updated"]))  
 {  
      $success_message = 'Data Updated Successfully';  
 }   
 ?> 
 <!DOCTYPE html>  
 <html>  
      <head>  
            <title>Update Invoice</title>  
      </head>  
      <body>
          <section id="content-wrapper"> 
           <div class="testData">
              <form method="post">  
                     <?php  
                     if(isset($_GET["edit"]))  
                     {  
                          if(isset($_GET["id"]))  
                          {  
                               $where = array(  
                                    'id'     =>     $_GET["id"]  
                               );  
                               $single_data = $data->select_where("payment", $where);  
                               foreach($single_data as $post)  
                               {  
                     ?> 
                     <div class="updateTitle">
                        <span >Upadte Payment Deatils</span>  
                     </div> 
                     <hr> 
                          <label>Invoice Id</label>  
                          <input type="text" name="invoice_id" value="<?php echo $post["invoice_id"]; ?>" class="form-control" />  
                          <br/>  
                          <label>Client Name</label>  
                          <input type="text" name="client_name" value="<?php echo $post["client_name"]; ?>" class="form-control" />  
                          <br/>
                          <label>Payment Type</label>  
                          <select name="payment_type" class="form-control" value="<?php echo $post["payment_type"]; ?>" class="form-control">
                            <option value="">Select</option>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="NetBanking">Net Banking</option>
                          </select>
                          <br/>
                          <label>Paid Date</label>
                          <input type="date" name="paid_date" value="<?php echo $post["paid_date"]; ?>" class="form-control"/>
                          <br>
                          <label>Paid Amount</label>
                          <input type="number" name="paid_amount" value="<?php echo $post["paid_amount"]; ?>" class="form-control"/>
                          <br>
                          <div class="btnGroup"> 
                          <input type="hidden" name="id" value="<?php echo $post["id"]; ?>" />  
                          <input type="submit" name="edit" class="btn btn-warning" id="editButton" value="SAVE"/> 
                          <button class="btn btn-warning" id="delButton"><a href="payment.php">Back</a></button>
                          </div>
                     <?php  
                               }  
                          }  
                     }  
                     else  
                     {  
                     ?>  
                          <label>Invoice Id</label>  
                          <input type="text" name="invoice_id" class="form-control" />  
                          <br />  
                          <label>Client Name</label>  
                          <input type="text" name="client_name" class="form-control" />  
                          <br />
                          <label>Payment Type</label>  
                          <select name="payment_type" class="form-control">
                            <option value="">Select</option>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="NetBanking">Net Banking</option>
                          </select>  
                          <br/>
                          <label>Paid Date</label>
                          <input type="date" name="paid_date" class="form-control"/>
                          <br>
                          <label>Paid Amount</label>
                          <input type="number" name="paid_amount" class="form-control"/>
                          <bnput type="submit" name="submit" class="btn btn-warning" value="Submit" />  
                     <?php  
                     }  
                     ?>  
                     <span class="text-success">  
                     <?php  
                     if(isset($success_message))  
                     {  
                          echo $success_message;  
                     }  
                     ?>  
                     </span>  
                </form>
           </div>
         </div>
       </div>
     </div>
   </div>
  </body>
</html>
