/***** Sidebar Toggler ****/

$("#sidebar-toggle").click(function(e) 
{
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
	
/**** Tooltip Indication ****/

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();   
});


/**** Delete ****/

$(document).ready(function(){  
    $('.delete').click(function(){  
        var client_id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete this post?"))  
           {  
                window.location = "client.php?delete=1&client_id="+client_id+"";  
           }  
           else  
           {  
                return false;  
           }  
    	});  	
	});

$(document).ready(function(){  
    $('.deleteInvoice').click(function(){  
        var id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete this post?"))  
           {  
                window.location = "invoice.php?delete=1&id="+id+"";  
           }  
           else  
           {  
                return false;  
           }  
      });   
  });
$(document).ready(function(){  
    $('.deletePurchase').click(function(){  
        var id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete this post?"))  
           {  
                window.location = "purchase.php?delete=1&id="+id+"";  
           }  
           else  
           {  
                return false;  
           }  
      });   
  });
$(document).ready(function(){  
    $('.deleteExpense').click(function(){  
        var id = $(this).attr("id");  
           if(confirm("Are you sure you want to delete this post?"))  
           {  
                window.location = "expense.php?delete=1&id="+id+"";  
           }  
           else  
           {  
                return false;  
           }  
      });   
  });

/**** Search ***/
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }

$('#search_text').keyup(function(){
 var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});



/** Datatables script file**/
$('#clientData').DataTable( {
    destroy: true,
    searching: false
});


$(document).ready(function()
{
    $("#clientData").DataTable(
    {
      order: [],
      columnDefs: [ { orderable: false, targets: [2,3,5] } ]
    });
});
$(document).ready(function()
{
    $("#invoiceData").DataTable(
    {
      order: [],
      columnDefs: [ { orderable: false, targets: [10] } ]
    });
});
$(document).ready(function()
{
    $("#paymentData").DataTable(
    {
      order: [],
      columnDefs: [ { orderable: false, targets: [2,3,5] } ]
    });
});
$(document).ready(function()
{
    $("#purchaseData").DataTable(
    {
      order: [],
      columnDefs: [ { orderable: false, targets: [8] } ]
    });
});
$(document).ready(function()
{
    $("#expenseData").DataTable(
    {
      order: [],
      columnDefs: [ { orderable: false, targets: [2,10] } ]
    });
});
