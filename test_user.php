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
           'name'     =>     mysqli_real_escape_string($data->con, $_POST['name']),  
           'email'   =>     mysqli_real_escape_string($data->con, $_POST['email']),
           'username'  =>     mysqli_real_escape_string($data->con, $_POST['username']),
           'password' =>     mysqli_real_escape_string($data->con, $_POST['password']),
           'number' =>     mysqli_real_escape_string($data->con, $_POST['number']),
           'address' =>     mysqli_real_escape_string($data->con, $_POST['address']),
      );  
      $where_condition = array(  
           'id'     =>     $_POST["id"]  
      );  
      if($data->update("users", $update_data, $where_condition))  
      {  
           header("location:index.php?updated=1");  
      }
      if(isset($_GET["updated"]))  
        {  
            $success_message = 'Data Updated successfully';  
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
                    if(isset($_GET["id"]))  
                    {  
                        $where = array(  
                            'id'     =>     $_GET["id"]  
                        );  
                        $single_data = $data->select_where("users", $where);  
                        foreach($single_data as $post)  
                        {  
            ?>

            <div class="updateTitle">
                <span >Upadte Client Deatils</span>  
            </div>
            <hr>
            <label>Name</label>  
            <input type="text" name="name" value="<?php echo $post["name"]; ?>" class="form-control" />  
            <br/>  
            <label>Email</label>  
            <input name="email" class="form-control" value="<?php echo $post["email"]; ?>">
            <label>username</label>  
            <input type="text" name="username" value="<?php echo $post["username"]; ?>" class="form-control" />  
            <br/>
            <label>Password</label>  
            <input type="text" name="password" value="<?php echo $post["password"]; ?>" class="form-control" />  
            <br />
            <label>Number</label>  
            <input type="number" name="number" value="<?php echo $post["number"]; ?>" class="form-control" />  
            <br />
            <label>Address</label>  
            <input type="text" name="address" value="<?php echo $post["address"]; ?>" class="form-control" />  
            <br/>
            <input type="hidden" name="id" value="<?php echo $post["id"]; ?>" /> 
            <input type="submit" value="SAVE" name="edit" class="btn btn-warning" id="editButton"> 
            <button class="btn btn-warning" id="delButton"><a href="index.php" >BACK</a></button>          
            <?php  
                        }  
                    }  
                }  
                else  
                {  
            ?>  
            
            <label>Name</label>  
            <input type="text" name=name class="form-control" />  
            <br/>  
            <label>Email</label>  
            <input type="email" name="email" class="form-control" /> 
            <br/>
            <label>username</label>  
            <input type="text" name="username" class="form-control" />
            <br/>
            <label>Password</label>  
            <input type="text" name="password" class="form-control" />  
            <br/>
            <label>Number</label>  
            <input type="number" name="number" class="form-control" />  
            <br />
            <label>Address</label>  
            <input type="text" name="address" class="form-control" />  
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
