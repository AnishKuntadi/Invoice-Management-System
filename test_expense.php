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
          'expense_types'      =>     mysqli_real_escape_string($data->con, $_POST['expense_types']),
          'companyname'        =>     mysqli_real_escape_string($data->con, $_POST['companyname']),  
          'invoice_num'        =>     mysqli_real_escape_string($data->con, $_POST['invoice_num']),
          'month'              =>     mysqli_real_escape_string($data->con, $_POST['month']),
          'created_date'       =>     mysqli_real_escape_string($data->con, $_POST['created_date']),
          'updated_date'       =>     mysqli_real_escape_string($data->con, $_POST['updated_date']),
          'due_date'           =>     mysqli_real_escape_string($data->con, $_POST['due_date']),
          'invoice_category'   =>     mysqli_real_escape_string($data->con, $_POST['invoice_category']),
          'invoice_status'     =>     mysqli_real_escape_string($data->con, $_POST['invoice_status']),
          'printed'            =>     mysqli_real_escape_string($data->con, $_POST['printed']), 
          'file'               =>     mysqli_real_escape_string($data->con, $_POST['file']) 
      );  
      $where_condition = array(  
           'id'     =>     $_POST["id"]  
      );  
      if($data->update("expense", $update_data, $where_condition))  
      {  
           header("location:expense.php?updated=1");  
      }  
  }

  if(isset($_GET["updated"]))  
  {  
      /*$success_message = 'Data Updated successfully'; */
      echo "<script>alert('Data Updated successfully');</script>"; 
  }  
 ?> 
 <!DOCTYPE html>  
 <html>  
      <head>  
            <title>Update Expense</title>  
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
                           $single_data = $data->select_where("expense", $where);  
                           foreach($single_data as $post)  
                           {  
                  ?>
                  <div class="updateTitle">
                    <span >Upadte Expense Invoices</span>  
                  </div>
                  <hr>
                  <div class="form-group row">
                  <div class="col-sm-6"> 
                    <label>Expense Type</label>
                    <select name="expense_types" value="<?php echo $post["expense_types"]; ?>" class="form-control">
                             <option class="Phone">Phone</option>
                             <option class="Internet">Internet</option>
                             <option class="Electricity">Electricity</option>
                             <option class="Credit_card">credit_card</option>
                             <option class="Travel">Travel</option>
                             <option class="Other">Other</option>
                          </select>
                    </select> 
                  </div>

                  <br/>

                  <div class="col-sm-6">
                    <label>Company Name</label>  
                    <input type="text" name="companyname" value="<?php echo $post["companyname"]; ?>" class="form-control">
                  </div>
                  </br>     
                  <div class="col-sm-6">
                    <label>Invoice Number</label>  
                    <input type="text" name="invoice_num" value="<?php echo $post["invoice_num"]; ?>" class="form-control"/>
                  </div>
                  <br/>
                  <div class="col-sm-6">
                    <label>Month</label>  
                    <select name="month" value="<?php echo $post["month"]; ?>" class="form-control">
                      <option value="">Select</option>
                      <option class="april">April</option>
                      <option class="may">May</option>
                      <option class="june">June</option>
                      <option class="july">July</option>
                      <option class="august">August</option>
                      <option class="september">September</option>
                      <option class="october">October</option>
                      <option class="november">November</option>
                      <option class="december">December</option>
                      <option class="january">January</option>
                      <option class="february">February</option>
                      <option class="march">March</option>
                    </select>
                  </div>

                  <br>

                  <div class="col-sm-6">
                    <label>Created Date</label>
                    <input type="date" name="created_date" value="<?php echo $post["created_date"]; ?>" class="form-control"/>
                  </div>

                  <br>

                  <div class="col-sm-6">
                    <label>Updated Date</label>
                    <input type="date" name="updated_date" value="<?php echo $post["updated_date"]; ?>" class="form-control"/>
                  </div>

                  <br>

                  <div class="col-sm-6">
                    <label>Due Date</label>
                    <input type="date" name="due_date" value="<?php echo $post["due_date"]; ?>" class="form-control"/>
                  </div>

                  <br>

                  <div class="col-sm-6">
                    <label>Invoice Category</label>
                    <select name="invoice_category" value="<?php echo $post["invoice_category"]; ?>" class="form-control">
                      <option class="monthly">Monthly</option>
                      <option class="yearly">Yearly</option>
                      <option class="as_and_when">As-And-When</option>
                    </select>
                  </div>

                  <br> 

                  <div class="col-sm-6">
                    <label>Invoice Status</label>
                      <select name="invoice_status" value="<?php echo $post["invoice_status"]; ?>" class="form-control">
                      <option class="paid">Paid</option>
                      <option class="pending">Pending</option>
                    </select>
                  </div>

                  <br/>

                  <div class="col-sm-6">
                    <label>Printed</label>
                    <select name="printed" value="<?php echo $post["printed"]; ?>" class="form-control">
                     <option class="yes">YES</option>
                     <option class="pending">NO</option>
                    </select> 
                  </div>

                  <br/>

                  <div class="col-sm-6">
                    <label>Attachment</label>
                    <input type="file" name="file" class="form-control" value="<?php echo $post["file"] ?>">
                    <input type="hidden" name="id" value="<?php echo $post["id"]; ?>" />
                  </div>
                </div>
                  <br/>  

                  <div class="btnGroup">
                    <input type="hidden" name="id" value="<?php echo $post["id"]; ?>" />  
                    <input type="submit" value="SAVE" name="edit" class="btn" id="editButton"> 
                    <button class="btn" id="delButton"><a href="#" id="<?php echo $post["id"]; ?>"class="del">DELETE</a></button>
                    <button class="btn btn-warning" id="delButton"><a href="expense.php">Back</a></button>
                  </div>
                  <?php  
                              }  
                          }  
                     }  
                     else  
                     {  
                  ?> 


                  <div class="form-group row">
                    <div class="col-sm-6">
                     <label>Expense Type</label>
                        <select name="expense_types" value="<?php echo $post["expense_types"]; ?>" class="form-control">
                           <option class="Phone">Phone</option>
                           <option class="Internet">Internet</option>
                           <option class="Electricity">Electricity</option>
                           <option class="Credit_card">credit_card</option>
                           <option class="Travel">Travel</option>
                           <option class="Other">Other</option>
                        </select>
                        </div> 

                     <div class="col-sm-6">
                        <label>Company Name</label>  
                        <input type="text" name="companyname" class="form-control" />  
                     </div>

                     <div class="col-sm-6">  
                        <label>Invoice Number</label>  
                        <input type="text" name="invoice_num" class="form-control" />  
                     </div>

                     <div class="col-sm-6">
                        <label>Month</label>  
                           <select name="month" class="form-control">
                              <option value="">Select</option>
                              <option class="april">April</option>
                              <option class="may">May</option>
                              <option class="june">June</option>
                              <option class="july">July</option>
                              <option class="august">August</option>
                              <option class="september">September</option>
                              <option class="october">October</option>
                              <option class="november">November</option>
                              <option class="december">December</option>
                              <option class="january">January</option>
                              <option class="february">February</option>
                              <option class="march">March</option>
                           </select>
                     </div>

                     <div class="col-sm-6">
                          <label>Created Date</label>
                          <input type="date" name="created_date" class="form-control"/>
                     </div>

                     <div class="col-sm-6">
                        <label>Updated Date</label>
                        <input type="date" name="updated_date" class="form-control"/>
                     </div>

                     <div class="col-sm-6">
                        <label>Due Date</label>
                        <input type="date" name="due_date" class="form-control"/>
                     </div>

                     <div class="col-sm-6">
                     <label>Invoice Category</label>
                        <select name="invoice_category" value="<?php echo $post["invoice_category"]; ?>" class="form-control">
                           <option class="monthly">Monthly</option>
                           <option class="yearly">Yearly</option>
                           <option class="as_and_when">As-And-When</option>
                        </select>
                      </div> 
                  
                     <div class="col-sm-6">
                        <label>Invoice Status</label>
                           <select name="invoice_status" class="form-control">
                              <option value="">Select</option>
                              <option class="paid">Paid</option>
                              <option class="pending">Pending</option>
                          </select>  
                     </div>

                     <div class="col-sm-6">
                     <label>Printed</label>
                      <select name="printed" value="<?php echo $post["printed"]; ?>" class="form-control">
                         <option class="yes">YES</option>
                         <option class="pending">NO</option>
                      </select>
                      </div>

                     <div class="col-sm-6">
                        <label>Attachment</label>
                        <input type="file" name="file" class="form-control" value="<?php echo $post["file"] ?>">
                     </div>
                     </div>

                     <div class="formSubmit">
                        <input type="submit" name="submit" value="submit" class="btn btn-warning">  
                     </div>

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
