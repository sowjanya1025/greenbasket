<?php
session_start();
//print_r($_SESSION);
include'account.php';
$account =  new account();

$accountId=$account->getCurrentUserId(); 

if(!isset($_SESSION['user_id']))
{
	header("Location:index.php");
}

if(!empty($_POST))
{
	if(isset($_POST['createitem'])=='createitem')
	{
		$itm_name = isset($_POST['item_name'])? $_POST['item_name'] : NULL;
		$itm_code = isset($_POST['item_code'])? $_POST['item_code'] : NULL;
		$itm_qty = isset($_POST['item_qty'])? $_POST['item_qty'] : NULL;
		$itm_image=isset($_FILES['item_image']['name']) ? $_FILES['item_image']['name'] : NULL;
		//$kyc = isset($_POST['kyc'])? $_POST['kyc'] : NULL;
		print_r($_POST);
		
		// image upload
		$newfilename="";
		if($itm_image !='')
		{
			$allowedExts = array("jpg", "jpeg", "png","gif","pdf");
			$extension = pathinfo($itm_image, PATHINFO_EXTENSION);
			if(in_array($extension, $allowedExts))
			{
				$temp = explode(".", $itm_image);
				$newfilename = 'item'.$accountId.'_'.rand().'.'.end($temp);
				move_uploaded_file($_FILES["item_image"]["tmp_name"],"images/" . $newfilename);
			}
		}
		
		// end image upload///
	 $account->create_Item($itm_name,$itm_code,$itm_qty,$newfilename);  // insert into db
	 header("Location:create_item.php?act=1");
	}
	
}


?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

  <!-- cdnjs.com / libraries / fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- js validation scripts -->
	<!-- end js validation scripts --> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" charset="utf-8"></script>

  <!-- css ekternal -->
  <link rel="stylesheet" href="css/style.css">
  <title>Create item codes</title>
  <style>
    body { background-color: #fafafa;   .redtext{ color: red; .greentext{ color: green;} 
 }
  </style>
</head>

<body>
  <!-- start wrapper -->
  <div class="wrapper">
   <nav id="sidebar">
      <div class="sidebar-header">
        <h3>Lorem Ipsum</h3>
      </div><?php echo include'side_bar.php'; ?></nav>
    <div id="content">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="btn btn-dark">
            <i class="fas fa-bars"></i><span> Toggle Sidebar</span>
          </button>
        </div>
      </nav>
      <br><br>
      <h2>Create Item</h2>
      <div id="carbon-block" class="my-3"></div>
	  <?php if(!empty($_GET['act']))
	   {
	  	 if($_GET['act']==1)
		 {			 ?>
	  		<div class="text-center"><b><span style="color:#009900">Registered Successfully</span></b></div>
	  <?php } } ?>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data" >
		<input type="hidden" name="createitem" value="createitem">
            <div class="form-group">
                <label for="item_name">Item:</label>
                <input type="text" class="form-control" id="item_name"
                    placeholder="Enter Name" name="item_name" required >
					<p id="name_err"></p>
            </div>
			<div class="form-group">
                <label for="item_code">Item code:</label>
                <input type="text" class="form-control" id="item_code"
                    placeholder="Enter Name" name="item_code" required>
					<p id="name_err"></p>
            </div>
			<div class="form-group">
                <label for="item_qty">Quantity:</label>
                <input type="text" class="form-control" id="item_qty"
                    placeholder="Enter Name" name="item_qty"  required>
					<p id="name_err"></p>
            </div>
			<div class="form-group">
                <label for="item_image">Image:</label>
                <input type="file" class="form-control" id="item_image"
                     name="item_image" required >
					<p id="cheque_err"></p>
            </div>          
		<input type="submit" id="submitbtn" value="Submit">
        </form>
    </div>
    </div>

  </div>
  <!-- wrapper and -->


  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<!--https://www.geeksforgeeks.org/form-validation-using-jquery/--> <!--// jquery validation code download-->
  <script>
  
    $(document).ready(function() {
      $("#sidebarCollapse").on('click',function() {
        $("#sidebar").toggleClass('active');
      });
    });
	
	$(document).ready(function()
	 {
	$('#item_code').blur(function(e)
	{
		let itm_code = $(this).val();
		$.ajax({
			type:"post",
			url:"check_itemAvailability.php",
			data:{id:itm_code},
			//dataType: 'json',
			success:function(response)
			{
				if(response == 1)
				{
					alert("Code already exists");
				}else if(response == 0)
				{
					alert("code is avaibale");
				}
			}
		});
	});

});

  </script>
</body>
</html>