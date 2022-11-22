 <?php  
 include 'database.php';  
 session_start();  
 $data = new DB_Con();
 $message = '';  
 if(isset($_POST["login"]))  
 {  
      $field = array(  
           'username'     =>     $_POST["username"],  
           'password'     =>     $_POST["password"]  
      );  
      if($data->required_validation($field))  
      {  
           if($data->login("users", $field))  
           {  
                $_SESSION["username"] = $_POST["username"];
                echo "<script>alert('login successfull.');</script>"; 
                header("location:index.php");  
           }  
           else  
           {  
                $message = $data->error; 
                /*echo "<script>alert('Please Enter valid username/password');</script>"; */ 
           }  
      }  
      else  
      {  
           $message = $data->error;  
      }  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>LogIn page</title>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

            <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

            <!--Personal Stylesheet-->
            <link rel="stylesheet" type="text/css" href="css/style.css">
      </head>  
      <body>
      <div class="loginBody">
          <div class="container-login">  
            <div class="wrap-login">
                <form method="post" class="login-form">
                  <span class="loginform-title">Invoice Management System</span> 
                  <hr>
                  <div class="loginTitle">
                    <p><b>Hello! Lets get started</b><br>Sign in to continue</p>  
                  </div>
                  
                    <?php  
                      if(isset($message))  
                      {  
                           echo '<label class="text-danger">'.$message.'</label>';  
                      }  
                    ?>  

                    <div class="wrap-input1 validate-input" data-validate = "Valid email is: a@b.c">
                      <label>Username</label>
                      <input class="input1" type="text" name="username">
                      <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input1 validate-input" data-validate="Enter password">
                      <label>Password</label>
                      <input class="input2" type="password" name="password">
                      <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                 
                     <div class="login-btn">
                          <button class="login-form-btn btn-warning" name="login" type="submit">
                            SIGN IN
                          </button>
                      </div>
                     <!--<input type="submit" name="login" class="btn btn-info" value="Login" />  -->
                     <div class="regLink">
                       <span class="txt1">Don't have an account?</span>
                       <a href="register.php" class="txt2">Create</a>
                     </div>
                </form> 
            </div>                 
          </div>
      </div>    
      </body>  
 </html>  