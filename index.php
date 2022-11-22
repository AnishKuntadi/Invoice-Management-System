<?php 
	include "database.php";
	include "includes/header.php";
	include 'includes/navbar.php';
  include 'includes/sidebar.php';
	include "includes/footer.php";

	$data = new DB_Con();
	$msg = '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice Management System</title>
</head>
<body>
	<!-- Body Contents-->
	<main>
  		<div id="content-wrapper">
  			<div class="welcomePage">
  				<h2>Welcome Admin!</h2>
  				<h5>Dashboard</h5>
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
			<!--- Stickers-->
			<div class="stickers">    
			    <div class="clientLabel col-2" >
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
             
		      &nbsp;
		      <div class="invoiceLabel col-2">
		      		<!--<h3 class="card-title pricing-card-title">100+<br>Clients</h3>-->
              <div class="stickersInfo">
                <div class="stickersIcon">
                  <i class="fa fa-money-check-alt fa-2x" style="color:orange"></i>
                  <h4>Purchases</h4>
                </div>
                <div class="stickersContent">
                  <p><span><?php echo rowCount($connect,"SELECT * FROM `purchase`");?></span>
                </div>
              </div>
		      	</div>
		      	&nbsp;
             <div class="invoiceLabel col-2">
              <!--<h3 class="card-title pricing-card-title">100+<br>Clients</h3>-->
              <div class="stickersInfo">
                <div class="stickersIcon">
                  <i class="fa fa-money-check-alt fa-2x" style="color:orange"></i>
                  <h4>Expenses</h4>
                </div>
                <div class="stickersContent">
                  <p><span><?php echo rowCount($connect,"SELECT * FROM `expense`");?></span>
                </div>
              </div>
            </div>
            &nbsp;
		      	<div class="paymentLabel col-2">
		      		<!--<h3 class="card-title pricing-card-title">60+<br>Invoices</h3>-->
              <div class="stickersInfo">
                <div class="stickersIcon">
                    <i class="fa fa-coins fa-2x" style="color:orange"></i>
                    <h4>Payments</h4>
                </div>
                <div class="stickersContent">
                  <p><span><?php echo rowCount($connect,"SELECT * FROM `payment`");?></span></p>
                </div>
              </div>
            </div>
      		</div>
      	</div>

      	<div class="dataTables">   		
      		
      		<!--- Client Table-->

      		<div class="clientDetails col-6">
        		<h2 class="tableHeader">Clients</h2>
        		<hr>
        		<table class="table responsive">
        				<tr>
        				  <th width="5%">Client Id</th>
        				  <th width="5%">Client Name</th>
        				  <th width="5%">Client Email</th>
        				  <th width="5%">Client Number</th>
        				  <th width="5%">Client Status</th>
        				</tr>
        				<?php  
                    $post_data = $data->select('client');  
                    foreach($post_data as $post)  
                    {  
                ?>
                <tr>
                  <td><?php echo $post["client_id"];?></td>
                  <td><?php echo $post["client_name"];?></td>
                  <td><?php echo $post["client_email"];?></td>
                  <td><?php echo $post["client_number"];?></td>
                  <td><?php echo $post["client_status"];?></td>
                </tr>
                <?php
                  }
                ?>
            </table>
            <hr>
            <h4 ><a href="client.php" class="viewMore">View all Clients</a></h4>	
          </div>

          <!--- Payment Details--->

          <div class="paymentDetails col-5">
            <h2>Payments</h2>
            <hr>
            <table class="table responsive">
              <tr>
               	<th>Invoice id</th>
               	<th>Client Name</th>
               	<th>Payment Type</th>
               	<th>Paid Date</th>
               	<th>Paid Amount</th>
              </tr>
              <?php
               	$post_data = $data->select('payment');
               	foreach($post_data as $post)
               	{
              ?>
              <tr>
               	<td><?php echo $post["invoice_id"];?></td>
               	<td><?php echo $post["client_name"];?></td>
               	<td><?php echo $post["payment_type"];?></td>
               	<td><?php echo $post["paid_date"];?></td>
               	<td><?php echo $post["paid_amount"];?></td>
              </tr>
              <?php 
               	}
              ?>
            </table>
            <hr>
            <h4 ><a href="payment.php" class="viewMore">View all Payments</a></h4>	
          </div>
      	</div>
      		

      	<!------- Invoice------->

      	<div class="dataTables1">
      		<div class="purchaseDetails col-6">
    			<h2>Purchase Invoices</h2>
				  <hr>
          <table class="table responsive">
            <tr>
              <th>Company Name</th>
              <th>Invoice Number</th>
              <th>Month</th>
              <th>Invoice Category</th>
              <th>Invoice Status</th>
            </tr>
            <?php
              $post_data = $data->select('purchase');
              foreach($post_data as $post)
              {
            ?>
            <tr>
              <td><?php echo $post["companyname"];?></td>
              <td><?php echo $post["invoice_num"];?></td>
              <td><?php echo $post["month"];?></td>
              <td><?php echo $post["invoice_category"];?></td>
              <td><?php echo $post["invoice_status"]?></td>
            </tr>
            <?php
              }
            ?>
          </table>
          <hr>
          <h4 ><a href="purchase.php" class="viewMore">View all Purchase Invoices</a></h4>
      	</div> 

        <div class="expenseDetails col-5">
          <h2>Expense Invoices</h2>
          <hr>
          <table class="table responsive">
            <tr>
              <th wisth="15%">Company Name</th>
              <th>Month</th>
              <th>Invoice Category</th>
              <th>Invoice Status</th>
            </tr>
            <?php
              $post_data = $data->select('expense');
              foreach($post_data as $post)
              {
            ?>
            <tr>
              <td><?php echo $post["companyname"];?></td>
              <td><?php echo $post["month"];?></td>
              <td><?php echo $post["invoice_category"];?></td>
              <td><?php echo $post["invoice_status"]?></td>
            </tr>
            <?php
              }
            ?>
          </table>
          <hr>
          <h4 ><a href="expense.php" class="viewMore">View all Expense Invoices</a></h4>
        </div> 
        </div>     	

      <div class="dataTables2">
      <!--- Invoice Category Details-->
      <div class="invoiceCategory col-4">
        <h2>Purchase Invoice Category</h2>
        <hr>
        <div class="invoiceCategoryTable" style="display: flex;">
        
        <div class="regularInvoices">
            <label>Regular Invoices</label><br>
            <div class="regular">
              <p><span class="regularCount"><?php echo rowCount($connect,"SELECT * FROM `purchase` WHERE `invoice_category`='regular'");?><span></p>
            </div>
        </div>
        <br>
        <div class="extraInvoices">
          <label>Extra Invoices</label><br>
          <div class="extra">
            <p><span class="extraCount"><?php echo rowCount($connect,"SELECT * FROM `purchase` WHERE `invoice_category`='extra'");?><span></p>
          </div>
        </div>
      </div>
      </div>

      <div class="invoiceCategory col-4">
        <h2>Expense Invoice Category</h2>
        <hr>
        <div class="invoiceCategoryTable" style="display: flex;">
        
        <div class="regularInvoices">
            <label>Monthly Invoices</label><br>
            <div class="regular">
              <p><span class="regularCount"><?php echo rowCount($connect,"SELECT * FROM `expense` WHERE `invoice_category`='monthly'");?><span></p>
            </div>
        </div>
        <br>
        <div class="extraInvoices">
          <label>Yearly Invoices</label><br>
          <div class="extra">
            <p><span class="extraCount"><?php echo rowCount($connect,"SELECT * FROM `expense` WHERE `invoice_category`='yearly'");?><span></p>
          </div>
        </div>
        <div class="extraInvoices">
          <label>As & When Invoices</label><br>
          <div class="extra">
            <p><span class="extraCount"><?php echo rowCount($connect,"SELECT * FROM `expense` WHERE `invoice_category`='as_and_when'");?><span></p>
          </div>
        </div>
      </div>
      </div>

      <!--Invoice Status Details-->

      <div class="companyDetails col-3">
      	<h2>Invoice Types</h2>
				<hr>
        <h5>Percentage of Expense and Purchase</h5>
			   <?php  
          $connect = mysqli_connect("localhost", "root", "", "invoice");
          $query = "SELECT invoice_type, count(*) as number FROM test_bills GROUP BY invoice_type";  
          $result = mysqli_query($connect, $query);  
         ?>
         <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['invoice_type', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["invoice_type"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: '',  
                      //is3D:true,  
                      pieHole: 0.8 
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>
           <div class="chart">  
                <div id="piechart" style="width: 380px; height: 200px;"></div>  
           </div>   
      </div>
  </div>
  </div>
</main>
  		
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

    <!-- Company Profile -->
    <div class="modal fade" id="comapnyProfile" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Comapny Profile</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
                <label>Comapny Name:</label><br>
                <label>Comapny Address:</label><br>
                <label>Email:</label><br>
                <label>Phone Number:</label><br>
                <label>Website:</label><br>
              <div class="modal-footer">
                <button type="button" class="btn btn-lg" data-dismiss="modal" id="modalBtn">Close</button>
              </div>
        </div>
      </div>
    </div>
</body>
</html>


