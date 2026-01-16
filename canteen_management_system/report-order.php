<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	if($_SESSION['user_details']['user_level_id'] == 2) {
		$SQL="SELECT * FROM `user`, `order` WHERE user_id = order_user_id AND user_id = ".$_SESSION['user_details']['user_id']." ORDER By order_id DESC";
	} else {
		$SQL="SELECT * FROM `user`, `order` WHERE user_id = order_user_id AND ORDER By order_id DESC";
	}
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
?>

<script>
$(document).on("click", ".delete-dialog", function () {
     var id = $(this).data('id');
	 $("#recordID").val( id );
});
function delete_record(shift_id)
{
	this.document.frm.act.value="delete_shift";
	this.document.frm.submit();
}
</script>

    <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <h1>
              Meal Order Report
            </h1>
          </div>
        </div>
      </div>
    </div>
    <!--breadcrumbs end-->

 <div class="container">
		 <?php if($_REQUEST['msg']) { ?>
		  <div class="alert alert-success fade in" style="margin:10px;">
			  <strong><?=$_REQUEST['msg']?></strong>
		  </div>
		  <?php } ?>
		<div class="row">
		  <div class="col-lg-12">
			<form name="frm" action="lib/shift.php" method="post">
			  <section class="panel">
				 
				  <table class="table table-striped table-advance table-hover" style="color:#000000">
				   <tbody>
					  <tr class="bg-primary">
						<th style="background-color:#34495e; color:#FFFFFF;">Sr. No.</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Customer Name</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Mobile</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Order Date</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Total Payment</th>
						<th style="background-color:#34495e; color:#FFFFFF;"><i class="icon_cogs"></i> Action</th>
					  </tr>
					  <?php 
						$sr_no=1;
						while($data = mysqli_fetch_assoc($rs))
						{
					  ?>
					  <tr>
						<td><?=$sr_no++?></td>
						<td><?=$data[user_name]?></td>
						<td><?=$data[user_mobile]?></td>
						<td><?=$data[order_date]?></td>
						<td><?=$data[order_amount]?></td>
						 <td>
						  <div class="btn-group">
						     <a href="order-confirmation.php?order_id=<?php echo $data[order_id] ?>" class="btn btn-success">View</a>
						  </div>
						  </td>
					  </tr>
					  <?php } ?>
				   </tbody>
				</table>
			  </section>
			  <input type="hidden" name="act" />
			  <input type="hidden" name="shift_id" id="recordID" />
			 </form>
		  </div>
	  </div>
	</div>

    <!--footer start-->
		<?php include_once("includes/footer.php"); ?>
    <!--small footer end-->
  </body>
</html>
