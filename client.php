<?php

/* include external files */
include 'database.php';
  include "includes/header.php";
  include 'includes/navbar.php';
  include 'includes/sidebar.php';
  include "includes/footer.php";



/*object creation*/
$data = new DB_Con();
$msg = '';

/*submit operation*/
if(isset($_POST["submit"]))
{
    $insert_data = array(
    'client_id' => mysqli_real_escape_string($data->con, $_POST['client_id']),
    'client_name' => mysqli_real_escape_string($data->con, $_POST['client_name']),
    'client_email' => mysqli_real_escape_string($data->con, $_POST['client_email']),
    'client_number' => mysqli_real_escape_string($data->con, $_POST['client_number']),
    'client_status' => mysqli_real_escape_string($data->con, $_POST['client_status']),
   );
   if($data->insert('client', $insert_data))
   {
   	echo "<script>alert('Data inserted successfully');</script>";
   }
}

if(isset($_POST["edit"]))  
 {  
      $update_data = array(  
           'client_id'     =>     mysqli_real_escape_string($data->con, $_POST['client_id']),  
           'client_name'   =>     mysqli_real_escape_string($data->con, $_POST['client_name']),
           'client_email'  =>     mysqli_real_escape_string($data->con, $_POST['client_email']),
           'client_number' =>     mysqli_real_escape_string($data->con, $_POST['client_number']),
           'client_status' =>     mysqli_real_escape_string($data->con, $_POST['client_status'])  
      );  
      $where_condition = array(  
           'client_id'     =>     $_POST["client_id"]  
      );  
      if($data->update("client", $update_data, $where_condition))  
      {  
           header("location:client.php?updated=1");  
      }  
 }  

if(isset($_GET["updated"]))  
{  
      echo "<script>alert('Data Updated successfully');</script>"; 
}

/*Delete Operation*/
if(isset($_GET["delete"]))  
{  
   $where = array(  
      'client_id'     =>     $_GET["client_id"]  
   );  
   if($data->delete("client", $where))  
   {  
      header("location:client.php?deleted=1");  
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
  			<h5><b>Dashboard</b>/Clients</h5>
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
    <div class="clientLabel col-3" >
      <!--<h3 class="card-title pricing-card-title">2019-20<br>Financial Year</h3>-->
      <div class="stickersInfo">
        <div class="stickersIcon">
          <i class="fa fa-users fa-2x" style="color:orange"></i> 
          <h4>Clients</h4>
        </div>
        <div class="stickersContent">
          <p><span ><?php echo rowCount($connect,"SELECT * FROM `client`");?></span></p> 
        </div>
      </div>
    </div>
    <div class="invoiceLabel col-3">
        <div class="stickersInfo">
          <div class="stickersIcon">
            <i class="fa fa-users fa-2x" style="color: green"></i>
            <h4>Active Clients</h4>
          </div>
          <div class="stickersContent">
            <p><span><?php echo rowCount($connect,"SELECT * FROM `client` WHERE `client_status`='Active'");?><span></p>    
          </div>
        </div>
    </div>
    <div class="paymentLabel col-3">
      <div class="stickersInfo">
        <div class="stickersIcon">
          <i class="fa fa-users fa-2x" style="color:red"></i>
          <h4>Inactive Clients</h4>
        </div>
        <div class="stickersContent">
          <p><?php echo rowCount($connect,"SELECT * FROM `client` WHERE `client_status`='Inactive'");?><span></p>
        </div>  
      </div>
    </div>
</div>
<div class="addButton">
		  <!-- Trigger the modal with a button -->
		  <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#myModal">Add Client</button>
		  <!-- Modal -->
		  <div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		    
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
                      if(isset($_GET["client_id"]))  
                      {  
                        $where = array(  
                          'client_id'     =>     $_GET["client_id"]  
                        );  
                        $single_data = $data->select_where("client", $where);  
                        foreach($single_data as $post)  
                        {  
                        ?>  
                        <label>Client Id</label>  
                          <input type="text" name="client_id" value="<?php echo $post["client_id"]; ?>" class="form-control"/>  
                        <br/>  
                        <label>Client Name</label>  
                          <input type="text" name="client_name" value="<?php echo $post["client_name"]; ?>" class="form-control"/>
                        <label>Client Email</label>  
                          <input type="text" name="client_email" value="<?php echo $post["client_email"]; ?>"class="form-control"/>  
                        <br />
                        <label>Client Number</label>  
                        <input type="text" name="client_number" value="<?php echo $post["client_number"]; ?>"class="form-control"/>  
                        <br/>
                          <label>Client Status</label>  
                            <select name="client_status" class="form-control" value="<?php echo $post["client_status"]; ?>" class="form-control">
                            <option value="">Select</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            </select> 
                          <br />    
                          <input type="hidden" name="client_id" value="<?php echo $post["client_id"]; ?>" />           
                          <input type="submit" value="save" name="edit" class="btn">
                     <?php  
                               }  
                          }  
                     }  
                     else  
                     {  
                     ?>  
                          <label>Client Id</label>  
                          <input type="text" name="client_id" class="form-control" />  
                          <br />  
                          <label>Client Name</label>  
                          <input type="text" name="client_name" class="form-control"> 
                          <br />
                          <label>Client Email</label>  
                          <input type="Email" name="client_email" class="form-control" />
                          <br />
                          <label>Client Number</label>  
                          <input type="Number" name="client_number" class="form-control" />  
                          <br />
                          <label>Client Status</label>  
                          <select name="client_status" class="form-control" class="form-control">
                          <option value="">Select</option>
                          <option value="Active" >Active</option>
                          <option value="Inactive">Inactive</option>
                          </select>
                          <br />
                          <div class="formSubmit">
                            <input type="submit" name="submit" value="submit" class="btn" style="font-size: 20px">  
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
  <table id="clientData" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Client ID</th>
          <th>Client Name</th>
          <th>Client Email</th>
          <th>Client Number</th>
          <th>Client Status</th>
          <th width="5%">Action</th>
        </tr>
      </thead>
      <?php  
        $post_data = $data->select('client');  
        foreach($post_data as $post)  
        {  
      ?>
      <tr>
        <td><?php echo $post["client_id"] ?></td>
        <td><?php echo $post["client_name"] ?></td>
            <td><?php echo $post["client_email"] ?></td>
            <td><?php echo $post["client_number"] ?></td>
            <td><?php echo $post["client_status"]?></td>
            <td class="text-right">
              <div class="dropdown ">
                <a href="#"data-toggle="dropdown" aria-expanded="false" class="actionBtn"><i class="fa fa-ellipsis-v" style="color: black"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a  href="test_client.php?edit=1&client_id=<?php echo $post['client_id']; ?>">Edit</a>
                    <br>
                  <a href="#" id="<?php echo $post["client_id"]; ?>" class="delete">Delete</a>
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






