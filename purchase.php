<?php
  //Include Database
  include 'database.php';
  include "includes/header.php";
  include 'includes/navbar.php';
  include 'includes/sidebar.php';
  include "includes/footer.php";

  $data = new DB_Con();
  $msg = '';
  if(isset($_POST["submit"]))  
  {  
        $insert_invoice = array(  
          'companyname'        =>     mysqli_real_escape_string($data->con, $_POST['companyname']),  
          'invoice_num'        =>     mysqli_real_escape_string($data->con, $_POST['invoice_num']),
          'month'              =>     mysqli_real_escape_string($data->con, $_POST['month']),
          'created_date'       =>     mysqli_real_escape_string($data->con, $_POST['created_date']),
          'updated_date'       =>     mysqli_real_escape_string($data->con, $_POST['updated_date']),
          'invoice_category'   =>     mysqli_real_escape_string($data->con, $_POST['invoice_category']),
          'invoice_status'     =>     mysqli_real_escape_string($data->con, $_POST['invoice_status']),
          'printed'            =>     mysqli_real_escape_string($data->con, $_POST['printed']), 
          'file'               =>     mysqli_real_escape_string($data->con, $_POST['file'])
        );
        if($data->insert('purchase', $insert_invoice))  
        {  
          echo "<script>alert('Data inserted successfully');</script>";
        }       
  }

  if(isset($_POST["edit"]))  
  {  
      $update_data = array(  
        'companyname'        =>     mysqli_real_escape_string($data->con, $_POST['companyname']),  
        'invoice_num'        =>     mysqli_real_escape_string($data->con, $_POST['invoice_num']),
        'month'              =>     mysqli_real_escape_string($data->con, $_POST['month']),
        'created_date'       =>     mysqli_real_escape_string($data->con, $_POST['created_date']),
        'updated_date'       =>     mysqli_real_escape_string($data->con, $_POST['updated_date']),
        'invoice_category'   =>     mysqli_real_escape_string($data->con, $_POST['invoice_category']),
        'invoice_status'     =>     mysqli_real_escape_string($data->con, $_POST['invoice_status']),
        'printed'            =>     mysqli_real_escape_string($data->con, $_POST['printed']), 
        'file'               =>     mysqli_real_escape_string($data->con, $_POST['file']) 
      );  
      $where_condition = array(  
           'id'     =>     $_POST["id"]  
      );  
      if($data->update("purchase", $update_data, $where_condition))  
      {  
           header("location:purchase.php?updated=1");  
      }  
  }

  if(isset($_GET["updated"]))  
  {  
      /*$success_message = 'Data Updated successfully'; */
      echo "<script>alert('Data Updated successfully');</script>"; 
  }
  if(isset($_GET["delete"]))  
  {  
      $where = array(  
           'id'     =>     $_GET["id"]  
      );  
      if($data->delete("purchase", $where))  
      {  
           header("location:purchase.php?deleted=1");  
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
  <title>Invoice Management System</title>  
</head>
<body>
    <section id="content-wrapper">
      <div class="welcomePage">
        <h2>Clients</h2>
        <h5><b>Dashboard</b>/Invoices</h5>
        </div>
        <div class="addButton">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">Add Invoice</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Purchase Invoices</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button> 
            </div>
            
            <div class="modal-body">
               <form method="post">  
                  <?php  
                     if(isset($_GET["edit"]))  
                     {  
                        if(isset($_GET["id"]))  
                        {  
                           $where = array(  
                           'id'     =>     $_GET["id"]  
                           );  
                           $single_data = $data->select_where("purchase", $where);  
                           foreach($single_data as $post)  
                           {  
                  ?>  
                  <label>Company Name</label>  
                  <input type="text" name="companyname" value="<?php echo $post["companyname"]; ?>" class="form-control">
                  </br>                      
                  <label>Invoice Number</label>  
                  <input type="text" name="invoice_num" value="<?php echo $post["invoice_num"]; ?>" class="form-control"/>
                  <br/>
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
                  <br>
                  <label>Created Date</label>
                  <input type="date" name="created_date" value="<?php echo $post["created_date"]; ?>" class="form-control"/>
                  <br>
                  <label>Updated Date</label>
                  <input type="date" name="updated_date" value="<?php echo $post["updated_date"]; ?>" class="form-control"/>
                  <br>
                  <label>Invoice Category</label>
                  <select name="invoice_category" value="<?php echo $post["invoice_category"]; ?>" class="form-control">
                     <option class="regular">Regular</option>
                     <option class="extra">Extra</option>
                  </select> 
                  <br />
                  <label>Invoice Status</label>
                  <select name="invoice_status" value="<?php echo $post["invoice_status"]; ?>" class="form-control">
                     <option class="paid">Paid</option>
                     <option class="pending">Pending</option>
                  </select>  
                  <br/>
                  <label>Printed</label>
                  <select name="printed" value="<?php echo $post["printed"]; ?>" class="form-control">
                     <option class="yes">YES</option>
                     <option class="pending">NO</option>
                  </select>  
                  <br/>
                  <label>File</label>
                  <input type="file" name="file" class="form-control" value="<?php echo $post["file"] ?>">  
                  <input type="hidden" name="id" value="<?php echo $post["id"]; ?>" />  
                  <input type="submit" name="edit" class="btn btn-info" value="Edit" />  
                  <?php  
                              }  
                          }  
                     }  
                     else  
                     {  
                  ?>  
                  <div class="form-group row">
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
                        <label>Invoice Category</label>
                           <select name="invoice_category" class="form-control">
                              <option value="">Select</option>
                              <option class="regular">Regular</option>
                              <option class="extra">Extra</option>
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



<div class="table-responsive">  
  <table id="purchaseData" class="table table-striped table-bordered">
  <thead>  
    <tr>  
      <th width="10%">Company Name</th>  
      <th width="10%">Invoice Number</th> 
      <th width="10%">Month</th>
      <th width="10%">Created Date</th>
      <th width="10%">Updated Date</th>
      <th width="15%">Invoice Category</th>
      <th width="15%">Invoice Status</th> 
      <th width="15%">Printed</th> 
      <th width="5%">Action</th> 
    </tr> 
  </thead> 
  <?php  
    $post_data = $data->select('purchase');  
      foreach($post_data as $post)  
      {  
    ?>  
    <tr>  
      <td><?php echo $post["companyname"]; ?></td>  
      <td><?php echo $post["invoice_num"]; ?></td>
      <td><?php echo $post["month"]; ?></td> 
      <td><?php echo $post["created_date"]; ?></td>
      <td><?php echo $post["updated_date"]; ?></td>
      <td><?php echo $post["invoice_category"]; ?></td>
      <td><?php echo $post["invoice_status"]; ?></td>
      <td><?php echo $post["printed"]; ?></td>
      <td class="text-right">
        <div class="dropdown ">
          <a href="#"data-toggle="dropdown" aria-expanded="false" class="actionBtn"><i class="fa fa-ellipsis-v" style="color: black"></i></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a  href="test_purchase.php?edit=1&id=<?php echo $post["id"]; ?>">Edit</a><br>
            <a href="#" id="<?php echo $post["id"]; ?>" class="deletePurchase">Delete</a><br>
            <a href="#" id="<?php echo $post["id"]; ?>" class="deletePurchase">View</a><br>
          </div>
        </div>
      </td>
      </tr>  
      <?php  
        }  
      ?>  
    </table>  
  </div>

  <!-- Modal -->
  <div class="modal fade" id="profileModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">User Profile</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>  
        </div>
        <div class="modal-body">
          <div class="userProfile">
            <?php  
              $post_data = $data->select('users');  
              foreach($post_data as $post)  
              {  
            ?> 
            <p><span>Name: </span><?php echo $post["name"]; ?></p>
            <br>
            <p><span>Email-Id: </span><?php echo $post["email"]; ?></p>
            <br>
            <p><span>Phone No: </span><?php echo $post["number"]; ?></p>
            <br>
            <p><span>Address: </span><?php echo $post["address"]; ?></p>
            <?php  
              }  
            ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-lg" id="modalBtn"><a href="test_user.php?edit=1&id=<?php echo $post['id']; ?>" >Edit</a></button>
          <button type="button" class="btn btn-lg" data-dismiss="modal" id="modalBtn">Close</button>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
