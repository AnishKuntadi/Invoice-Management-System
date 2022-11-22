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
        if($data->insert('test_bills', $insert_invoice))  
        {  
          echo "<script>alert('Data inserted successfully');</script>";
        }       
  }

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
      /*$success_message = 'Data Updated successfully'; */
      echo "<script>alert('Data Updated successfully');</script>"; 
  }
  if(isset($_GET["delete"]))  
  {  
      $where = array(  
           'id'     =>     $_GET["id"]  
      );  
      if($data->delete("test_bills", $where))  
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
  <title>Invoice Management System</title>  
</head>
<body>
    <section id="content-wrapper">
      <div class="welcomePage">
        <h2>Clients</h2>
        <h5><b>Dashboard</b>/Invoices</h5>
        </div>

        <?php
        //database connection
        $connect = new PDO('mysql:host=localhost;dbname=invoice','root','');
        //create function for multiple time uses

        function rowCount($connect, $query)
        {
          $stmt = $connect->prepare($query);
          $stmt->execute();
          return $stmt->rowCount();
        }
        ?>

        <div class="clientInfo">
            <!--<div class="totalClient">
              <p>Total Invoices<br><span class="ClientCount"><?php echo rowCount($connect,"SELECT * FROM `test_bills`");?></span></p>      
            </div>-->
            <div class="clientLabel col-3" >
              <div class="stickersInfo">
                <div class="stickersIcon">
                  <i class="fa fa-money-check-alt fa-2x" style="color:orange"></i>
                  <h4>Invoices</h4>
                </div>
                <div class="stickersContent">
                  <p><span><?php echo rowCount($connect,"SELECT * FROM `test_bills`");?></span>
                </div>
              </div>
            </div>
            <div class="invoiceLabel col-3">
              <div class="stickersInfo">
                <div class="stickersIcon">
                  <i class="fa fa-check-circle fa-2x" style="color: orange"></i>
                  <h4>Paid Invoices</h4>
                </div>
                <div class="stickersContent">
                  <p><?php echo rowCount($connect,"SELECT * FROM `test_bills` WHERE `invoice_status`='paid'");?><span></p>
                </div>
              </div>
            </div>
            <div class="paymentLabel col-3">
              <div class="stickersInfo">
                <div class="stickersIcon">
                  <i class="fa fa-stopwatch fa-2x" style="color:orange"></i>
                  <h4>Pending Invoices</h4>
                </div>
                <div class="stickersContent">
                  <p><?php echo rowCount($connect,"SELECT * FROM `test_bills` WHERE `invoice_status`='pending'");?><span></p>
                </div>  
              </div>
            </div>
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
              <h3 class="modal-title">Add Client</h3>
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
                           $single_data = $data->select_where("test_bills", $where);  
                           foreach($single_data as $post)  
                           {  
                  ?>  
                  <label>Invoice Number</label>  
                  <input type="text" name="invoice_num" value="<?php echo $post["invoice_num"]; ?>" class="form-control">
                  </br>                      
                  <label>Client Name</label>  
                  <input type="text" name="client_name" value="<?php echo $post["client_name"]; ?>" class="form-control"/>
                  <br/>
                  <label>Client Id</label>  
                  <input type="text" name="client_id" value="<?php echo $post["client_id"]; ?>" class="form-control" />  
                  <br/>
                  <label>Invoice Type</label>  
                  <select name="invoice_type" value="<?php echo $post["invoice_type"]; ?>" class="form-control">
                     <option value="">Select</option>
                     <option class="expense">Expense</option>
                     <option class="purchase">Purchase</option>
                  </select>
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
                  <label>Due Date</label>
                  <input type="date" name="due_date" value="<?php echo $post["due_date"]; ?>" class="form-control"/>
                  <br/>
                  <label>Invoice Category</label>
                  <select name="invoice_category" value="<?php echo $post["invoice_category"]; ?>" class="form-control">
                     <option class="regular">Regular</option>
                     <option class="extra">Extra</option>
                  </select> 
                  <br />
                  <label>Invoice Type</label>
                  <select name="invoice_status" value="<?php echo $post["invoice_status"]; ?>" class="form-control">
                     <option class="paid">Paid</option>
                     <option class="pending">Pending</option>
                  </select>  
                  <br />  
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
                        <label>Invoice Number</label>  
                        <input type="text" name="invoice_num" class="form-control" />  
                     </div>
                     <div class="col-sm-6">  
                        <label>Client Name</label>  
                        <input type="text" name="client_name" class="form-control" />  
                     </div>
                     <div class="col-sm-6">
                        <label>Client Id</label>  
                        <input type="text" name="client_id" class="form-control" />  
                     </div>
                     <div class="col-sm-6">
                        <label>Invoice Type</label>  
                        <select name="invoice_type" class="form-control">
                           <option value="">Select</option>
                           <option class="expense">Expense</option>
                           <option class="purchase" >Purchase</option>
                        </select>
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
                        <label>Upload File</label>
                        <input type="file" name="uploaded_file"></input><br/><br>
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
  <table id="invoiceData" class="table table-striped table-bordered">
  <thead>  
    <tr>  
      <th width="10%">Invoice Number</th>  
      <th width="15%">Client Name</th>  
      <th width="10%">Client Id </th>  
      <th width="10%">Invoice type</th>
      <th width="10%">Month</th>
      <th width="10%">Created Date</th>
      <th width="10%">Updated Date</th>
      <th width="10%">Due Date</th>
      <th width="10%">Invoice Category</th>
      <th width="15%">Invoice Status</th> 
      <th width="5%">Action</th> 
    </tr> 
  </thead> 
    <?php  
      $post_data = $data->select('test_bills');  
      foreach($post_data as $post)  
      {  
    ?>  
    <tr>  
      <td><?php echo $post["invoice_num"]; ?></td>  
      <td><?php echo substr($post["client_name"], 0, 200); ?></td>
      <td><?php echo $post["client_id"]; ?></td>
      <td><?php echo $post["invoice_type"]; ?></td>
      <td><?php echo $post["month"]; ?></td> 
      <td><?php echo $post["created_date"]; ?></td>
      <td><?php echo $post["updated_date"]; ?></td>
      <td><?php echo $post["due_date"]; ?></td>
      <td><?php echo $post["invoice_category"]; ?></td>
      <td><?php echo $post["invoice_status"]; ?></td>
      <td class="text-right">
        <div class="dropdown ">
          <a href="#"data-toggle="dropdown" aria-expanded="false" class="actionBtn"><i class="fa fa-ellipsis-v" style="color: black"></i></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a  href="test_invoice.php?edit=1&id=<?php echo $post["id"]; ?>">Edit</a>
            <br> 
            <a href="#" id="<?php echo $post["id"]; ?>" class="deleteInvoice">Delete</a>
            <br>
            <a href="" data-toggle="modal" data-target="#uploadModal" name="myPrfl">Upload</a>
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

      <!-- Modal -->
        <div class="modal fade" id="uploadModal" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Upload Invoice</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="uploadFile">
                  <form enctype="multipart/form-data" action="upload.php" method="POST">
                    <input type="file" name="uploaded_file"></input><br/><br>
                    <input type="submit" value="Upload"></input>
                  </form>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-lg" data-dismiss="modal" id="modalBtn">Close</button>
            </div>
          </div>
        </div>
      </div>

</section>
</div>
</body>
</html>
<script type="text/javascript">
  $(document).ready(function(){
    $("#clientData").DataTable();
  });
</script>