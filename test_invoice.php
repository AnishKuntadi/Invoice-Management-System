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
           'invoice_num'        =>     mysqli_real_escape_string($data->con, $_POST['invoice_num']),  
           'client_name'        =>     mysqli_real_escape_string($data->con, $_POST['client_name']),
           'client_id'          =>     mysqli_real_escape_string($data->con, $_POST['client_id']),
           'invoice_type'       =>     mysqli_real_escape_string($data->con, $_POST['invoice_type']),
           'month'              =>     mysqli_real_escape_string($data->con, $_POST['month']),
           'created_date'       =>     mysqli_real_escape_string($data->con, $_POST['created_date']),
           'updated_date'       =>     mysqli_real_escape_string($data->con, $_POST['updated_date']),
           'due_date'           =>     mysqli_real_escape_string($data->con, $_POST['due_date']),
           'invoice_category'   =>     mysqli_real_escape_string($data->con, $_POST['invoice_category']),
           'invoice_status'     =>     mysqli_real_escape_string($data->con, $_POST['invoice_status'])  
      );  
      $where_condition = array(  
           'id'     =>     $_POST["id"]  
      );  
      if($data->update("test_bills", $update_data, $where_condition))  
      {  
           header("location:invoice.php?updated=1");  
      }  
 }  
 if(isset($_GET["updated"]))  
 {  
     echo "<script>alert('Data inserted successfully');</script>";
 } 
 if(isset($_GET["deleteInvoice"]))  
  {  
      $where = array(  
           'id'     =>     $_GET["id"]  
      );  
      if($data->deleteInvoice("test_bills", $where))  
      {  
           header("location:invoice.php?deleted=1");  
      }  
  }
  
  if(isset($_GET["deleted"]))  
  {  
      /*$success_message = 'Data Deleted successfully';*/
      echo "<script>alert('Data Deleted successfully');</script>";   
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
                'id'  =>  $_GET["id"]  
              );  
              $single_data = $data->select_where("test_bills", $where);  
              foreach($single_data as $post)  
              {  
              ?>
              <div class="updateTitle">
                <span >Upadte Invoice Deatils</span>  
              </div> 
              <hr>
              <div class="form-group row">
                <div class="col-sm-6">
                  <label>Invoice Number</label>  
                  <input type="text" name="invoice_num" value="<?php echo $post["invoice_num"]; ?>" class="form-control" />  
                </div>
                <div class="col-sm-6"> 
                  <label>Client Name</label>  
                  <input type="text" name="client_name" value="<?php echo $post["client_name"]; ?>" class="form-control" />  
                </div>
                <div class="col-sm-6">
                  <label>Client Id</label>  
                  <input type="text" name="client_id" value="<?php echo $post["client_id"]; ?>" class="form-control" />  
                </div>
                <div class="col-sm-6">
                  <label>Invoice Type</label>  
                  <select name="invoice_type" value="<?php echo $post["invoice_type"]; ?>" class="form-control">
                      <option class="expense">Expense</option>
                      <option class="purchase">Purchase</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <label>Month</label>  
                  <select name="month" value="<?php echo $post["month"]; ?>" class="form-control">
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
                  <input type="date" name="created_date" value="<?php echo $post["created_date"]; ?>" class="form-control"/>
                </div>
                <div class="col-sm-6">
                  <label>Updated Date</label>
                  <input type="date" name="updated_date" value="<?php echo $post["updated_date"]; ?>" class="form-control"/>
                </div>
                <div class="col-sm-6">
                  <label>Due Date</label>
                  <input type="date" name="due_date" value="<?php echo $post["due_date"]; ?>" class="form-control"/>
                </div>
                <div class="col-sm-6">
                  <label>Invoice Category</label>
                  <select name="invoice_category" value="<?php echo $post["invoice_category"]; ?>" class="form-control">
                    <option class="regular">Regular</option>
                    <option class="extra">Extra</option>
                </select> 
                </div>
                <div class="col-sm-6">
                  <label>Invoice Type</label>
                  <select name="invoice_status" value="<?php echo $post["invoice_status"]; ?>" class="form-control">
                    <option class="regular">Paid</option>
                    <option class="extra">Pending</option>
                  </select>  
                </div>  
                </div>
                <div class="btnGroup">
                  <input type="hidden" name="id" value="<?php echo $post["id"]; ?>" />  
                  <input type="submit" value="SAVE" name="edit" class="btn" id="editButton"> 
                  <button class="btn" id="delButton"><a href="#" id="<?php echo $post["id"]; ?>"class="del">DELETE</a>
                  <button class="btn btn-warning" id="delButton"><a href="invoice.php">Back</a></button>
                </div>                           
                <?php  
                        }  
                    }  
                }  
                else  
                {  
                    ?>  
                          <label>Invoice Number</label>  
                          <input type="text" name="invoice_num" class="form-control" />  
                          <br />  
                          <label>Client Name</label>  
                          <input type="text" name="client_name" class="form-control" />  
                          <br />
                          <label>Client Id</label>  
                          <input type="text" name="client_id" class="form-control" />  
                          <br/>
                          <label>Invoice Type</label>  
                          <select name="invoice_type" class="form-control">
                              <option class="expense">Expense</option>
                           /*   <option class="purchase">Purchase</option>
                          </select>
                          <br/>
                          <label>Month</label>  
                          <select name="month" class="form-control">
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
                          <br>
                          <label>Created Date</label>
                          <input type="date" name="created_date" class="form-control"/>
                          <br>
                          <label>Updated Date</label>
                          <input type="date" name="updated_date" class="form-control"/>
                          <br>
                          <label>Due Date</label>
                          <inp*/ut type="date" name="due_date" class="form-control"/>
                          <br>
                          <label>Invoice Category</label>
                          <select name="invoice_category" class="form-control">
                              <option class="regular">Regular</option>
                              <option class="extra">Extra</option>
                          </select> 
                          <br/>
                          <label>Invoice Status</label>
                          <select name="invoice_status" class="form-control">
                              <option class="regular">Paid</option>
                              <option class="extra">Pending</option>
                          </select>  
                          <br/> 
                          <input type="submit" name="submit" class="btn btn-warning" value="Submit" />  
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

