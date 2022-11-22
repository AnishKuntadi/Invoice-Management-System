<?php
// include Function  file
include_once 'database.php';
include 'includes/header.php';
include 'includes/footer.php';
// Object creation
$data=new DB_con();
if(isset($_POST['submit']))
{
	// Posted Values
	$reg_user = array(
		'name' => mysqli_real_escape_string($data->con, $_POST["name"]),
		'username' => mysqli_real_escape_string($data->con, $_POST["username"]),
		'email' => mysqli_real_escape_string($data->con, $_POST["email"]),
		'password' => mysqli_real_escape_string($data->con, $_POST["password"]),
		'number' => mysqli_real_escape_string($data->con, $_POST["number"]),
		'address' => mysqli_real_escape_string($data->con, $_POST["address"]),
	);
	if($data->registration('users',$reg_user))
	{
		// Message for successfull insertion
		echo "<script>alert('Registration successfull.');</script>";
		echo "<script>window.location.href='login.php'</script>";
	}
	else
	{
		// Message for unsuccessfull insertion
		echo "<script>alert('Something went wrong. Please try again');</script>";	
		echo "<script>window.location.href='login.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
	<div class="loginBody">
		<div class="container-login">
			<div class="wrap-login">
				<form class="regForm" method="POST" action="" >
					<span class="loginform-title">Invoice Management System</span> 
	                <hr>
	                <div class="registerTitle">
	                	<p><b>New Here?</b><br>Sigining up is esay.It only takes a few steps.</p>
	                </div>
	                <div class="wrap-input1 validate-input" data-validate="Enter password">
                      <label>Name</label>
                      <input class="input1" type="text" name="name">
                    </div>
                    <div class="wrap-input1 validate-input" data-validate="Enter password">
                      <label>Email</label>
                      <input class="input1" type="email" name="email">
                    </div>
                    <div class="wrap-input1 validate-input" data-validate="Enter password">
                      <label>Number</label>
                      <input class="input1" type="number" name="number">
                    </div>
                    <div class="wrap-input1 validate-input" data-validate="Enter password">
                      <label>Address</label>
                      <input class="input1" type="text" name="address">
                    </div>
                    <div class="wrap-input1 validate-input" data-validate="Enter password">
                      <label>Username</label>
                      <input class="input1" type="text" name="username">
                    </div>
                    <div class="wrap-input1 validate-input" data-validate="Enter password">
                      <label>Password</label>
                      <input class="input2" type="password" name="password">
                    </div>
                    <div class="reg-btn">
                        <button class="reg-form-btn btn-warning" name="submit" type="submit">
                            REGISTER
                        </button>
                    </div>
                    <div class="logLink">
                    	<span class="txt1">Already have an account?</span>
                    	<a href="login.php" class="txt2">Login</a>
                    </div>
                              
				</form>
			</div>
		</div>
	</div>
</body>
</html>