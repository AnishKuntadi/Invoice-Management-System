<?php  
 //test_class.php  
 include 'database.php';
  include "includes/header.php";
  include "includes/footer.php";


 $data = new DB_Con();  
 $success_message = ''; 


/* Update condition for client */

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
      if(isset($_GET["updated"]))  
        {  
            $success_message = 'Data Updated';  
        }    
}     

/* Delete condition for client */

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
    <title>Test Client</title>  
</head>  
<body>
    <section id="content-wrapper">
    <div class="testData">
        <form method="post" class="clientForm" >  
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

            <div class="updateTitle">
                <span >Upadte Client Deatils</span>  
            </div>
            <hr>
            <label>Client Id</label>  
            <input type="text" name="client_id" value="<?php echo $post["client_id"]; ?>" class="form-control" />  
            <br/>  
            <label>Client Name</label>  
            <textarea name="client_name" class="form-control"><?php echo $post["client_name"]; ?></textarea>
            <label>Client Email</label>  
            <input type="text" name="client_email" value="<?php echo $post["client_email"]; ?>" class="form-control" />  
            <br/>
            <label>Client Number</label>  
            <input type="text" name="client_number" value="<?php echo $post["client_number"]; ?>" class="form-control" />  
            <br />
            <label>Client Status</label>  
            <select name="client_status" class="form-control" value="<?php echo $post["client_number"]; ?>" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select> 
            <br/> 
            <div class="btnGroup"> 
            <input type="hidden" name="client_id" value="<?php echo $post["client_id"]; ?>" /> 
            <input type="submit" value="SAVE" name="edit" class="btn btn-warning" id="editButton"> 
            <button class="btn btn-warning" id="delButton"><a href="#" id="<?php echo $post["client_id"]; ?>" class="delete">Delete</a></button>
            <button class="btn btn-warning" id="delButton"><a href="client.php">Back</a></button>    
            </div>             
            <?php  
                        }  
                    }  
                }  
                else  
                {  
            ?>  
            
            <label>Client Id</label>  
            <input type="text" name="client_id" class="form-control" />  
            <br/>  
            <label>Client Name</label>  
            <textarea name="client_name" class="form-control"></textarea>  
            <br/>
            <label>Client Email</label>  
            <input type="Email" name="client_email" class="form-control" />
            <br/>
            <label>Client Number</label>  
            <input type="Number" name="client_number" class="form-control" />  
            <br/>
            <label>Client Status</label>  
            <select name="client_status" class="form-control" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
            <br/>  
            <input type="submit" name="submit" class="btn btn-info" value="Submit" value="edit"/>  
            <?php  
                }  
            ?>

            <!-- Display Success Message -->
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
    </section>
</body>
</html>
