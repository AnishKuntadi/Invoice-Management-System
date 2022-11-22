<?php
  
  include 'database.php';
  include "includes/header.php";
  include 'includes/navbar.php';
  include 'includes/sidebar.php';
  include "includes/footer.php";

$data = new DB_Con();
$msg = '';
if(isset($_POST["submit"]))
{
   $insert_payment = array(
   'invoice_id' => mysqli_real_escape_string($data->con, $_POST['invoice_id']),
   'client_name' => mysqli_real_escape_string($data->con, $_POST['client_name']),
   'payment_type' => mysqli_real_escape_string($data->con, $_POST['payment_type']),
   'paid_date' => mysqli_real_escape_string($data->con, $_POST['paid_date']),
   'paid_amount' => mysqli_real_escape_string($data->con, $_POST['paid_amount'])
   );
   if($data->insertPayment('payment', $insert_payment))
   {
	   /*$msg = "Inserted Data Successfully!";*/
	   echo "<script>alert('Data inserted successfully');</script>";
   }
  }
if(isset($_POST["edit"]))  
{  
      $update_data = array(  
           'invoice_id' => mysqli_real_escape_string($data->con, $_POST['invoice_id']),
		   'client_name' => mysqli_real_escape_string($data->con, $_POST['client_name']),
		   'payment_type' => mysqli_real_escape_string($data->con, $_POST['payment_type']),
		   'paid_date' => mysqli_real_escape_string($data->con, $_POST['paid_date']),
		   'paid_amount' => mysqli_real_escape_string($data->con, $_POST['paid_amount'])  
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
      /*$success_message = 'Data Updated successfully'; */
      echo "<script>alert('Data Updated successfully');</script>"; 
 } 

 if(isset($_GET["delete"]))  
 {  
      $where = array(  
           'id'     =>     $_GET["id"]  
      );  
      if($data->delete("payment", $where))  
      {  
           header("location:payment.php?deleted=1");  
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
  			<h2>Payments</h2>
  			<h5><b>Dashboard</b>/Payments</h5>
      	</div>
      	<div class="addButton">
		<!-- Trigger the modal with a button -->
		  	<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">Add Payment</button>
		  	<!-- Modal -->
		  	<div class="modal fade" id="myModal" role="dialog">
		    	<div class="modal-dialog">
		      	<!-- Modal content-->
		      		<div class="modal-content">
		        		<div class="modal-header">
		        			<h3 class="modal-title">Add Payment</h3>
		          			<button type="button" class="close" data-dismiss="modal">&times;</button> 
		        		</div>
		        		<div class="modal-body">
							<form name="insert" action="" method="post">
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
                         	<label>Invoice Id</label>  
		                    <input type="text" name="invoice_id" value="<?php echo $post["invoice_id"]; ?>" class="form-control" />  
		                    <br />  
		                    <label>Client Name</label>  
		                    <input type="text" name="client_name" value="<?php echo $post["client_name"]; ?>" class="form-control" />
		                    <label>Payment Type</label>  
		                    <select name="payment_type" class="form-control" value="<?php echo $post["payment_type"]; ?>" class="form-control">
		                        <option value="">Select</option>
		                        <option value="cash">Cash</option>
		                        <option value="cheque">Cheque</option>
		                        <option value="NetBanking">Net Banking</option>
		                    </select>  
		                    <br />
		                    <label>Paid Date</label>  
		                    <input type="date" name="paid_date" value="<?php echo $post["paid_date"]; ?>" class="form-control" /> <br>
		                    <label>Paid Amount</label>  
		                    <input type="number" name="paid_amount" value="<?php echo $post["paid_amount"]; ?>" class="form-control" /> <br>
		                    <input type="hidden" name="client_id" value="<?php echo $post["client_id"]; ?>" />           
		                    <input type="submit" value="save" name="edit" class="btn btn-warning">
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
		                    <input type="text" name="client_name" class="form-control"> 
		                    <br />
		                    <label>Payment Type</label>  
		                    <select name="payment_type" class="form-control">
		                        <option value="">Select</option>
		                        <option value="cash">Cash</option>
		                        <option value="cheque">Cheque</option>
		                        <option value="NetBanking">Net Banking</option>
		                    </select>
		                    <br />
		                    <label>Paid Date</label>  
		                    <input type="date" name="paid_date" class="form-control" />  
		                    <br />
		                    <label>Paid Amount</label>  
		                    <input type="number" name="paid_amount" class="form-control" /> <br>
		   
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
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="table-responsive"> 
	<table id="paymentData" class="table table-striped table-bordered">
		<thead>
		<tr>
			<th>Invoice Id</th>
			<th>Client Name</th>
			<th>Payent Type</th>
			<th>Paid Date</th>
			<th>Paid Amount</th>
			<th width="5%">Action</th>
		</tr>
	</thead>
		<?php
			$post_data = $data->select('payment');
			foreach ($post_data as $post) {
		?>
		<tr>
			<td><?php echo $post["invoice_id"];?></td>
			<td><?php echo $post["client_name"];?></td>
			<td><?php echo $post["payment_type"];?></td>
			<td><?php echo $post["paid_date"];?></td>
			<td><?php echo $post["paid_amount"];?></td>
			<td class="text-right">
				<div class="dropdown ">
					<a href="#"data-toggle="dropdown" aria-expanded="false" class="actionBtn"><i class="fa fa-ellipsis-v" style="color: black"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a  href="test_payment.php?edit=1&id=<?php echo $post["id"]; ?>">Edit</a>
                        <br>
              			<a href="#" id="<?php echo $post["id"]; ?>" class="delete">Delete</a>
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
</div>
</body>
</html>


