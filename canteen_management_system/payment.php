<?php 
	session_start();

	include_once("includes/header.php"); 
	if($_REQUEST[order_id])
	{
		$SQL="SELECT * FROM `order` WHERE order_id = $_REQUEST[order_id]";
		$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($rs);
	}
?>
<script>
jQuery(function() {
	jQuery( "#payment_date" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	   yearRange: "0:+1",
	   dateFormat: 'd MM,yy'
	});
});
</script>
    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1>Payment Management</h1>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

    <!--container start-->
    <div class="container w">
		<div class="row centered">
		<div class="col-sm-8">
		<div style="clear:both"></div>
			<form class="form-horizontal " method="post" action="order-confirmation.php">
								 <div><img src="img/payment.png" style="width:500px;"></div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Name of Card</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label">Card No</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" required>
                                      </div>
                                  </div>
								  <div class="form-group">
									<label class="control-label col-sm-2" for="email">Card Type : </label>
									<div class="col-sm-10">
									  <select class="form-control" id="sel1" name="card_type" required>
										<?php echo get_new_optionlist("card_type","ct_id","ct_name",0); ?>
									  </select>
									</div>
								  </div>
								  <div class="form-group">
									<label class="control-label col-sm-2" for="email">Card Expiry : </label>
									<div class="col-sm-10">
									  <select class="form-control" id="sel1" required style="width:150px; float:left; margin-right:10px; ">
										<option>Month</option>
										<option>January</option>
										<option>February</option>
										<option>March</option>
										<option>April</option>
										<option>May</option>
										<option>June</option>
										<option>July</option>
										<option>August</option>
										<option>September</option>
										<option>October</option>
										<option>November</option>
										<option>December</option>
									  </select>
									  <select class="form-control" id="sel1" required style="width:150px; float:left; ">
										<option>Year</option>
										<?php for($year=2017 ; $year<=2030; $year++) { ?>
											<option><?=$year?></option>
										<?php } ?>
									  </select>
									</div>
								  </div>
								  <div class="form-group">
                                      <label class="col-sm-2 control-label">Amount</label>
                                      <div class="col-sm-10">
                                          <input type="text" class="form-control" required name="order_amount" value="<?=$data[order_amount]?> Rs." readonly> 
                                      </div>
                                  </div>
                                  <div class="form-group"> 
				<label class="control-label col-sm-2" for="email"></label>
				<div class="col-sm-8" style="text-align:left;">
				  <button type="submit" class="btn btn-primary" style="width:140px; padding:8px;">Make Payment</button>
				</div>
			  </div>
			  <input type="hidden" name="act" value="save_order">
			  <input type="hidden" name="order_id" value="<?=$_REQUEST[order_id]?>">
			</form>
			</div>
			<div class="col-sm-3" style="margin-bottom:10px;">
				<div><img src="img/banner.jpg" style="width:250px;"></div>
			</div>
		</div>
	</div>
    <!--container end-->
<?php include_once("includes/footer.php"); ?>
