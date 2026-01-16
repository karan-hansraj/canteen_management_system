<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[order_id])
	{
		$SQL="SELECT * FROM `user`,`order` WHERE user_id = order_user_id AND order_id = ".$_REQUEST[order_id];
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
                    <h1>Order Confirmation </h1>
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
			<form class="form-horizontal " method="post">
			  <div class="form-group" style="color:#000000; font-size:20px">
				  Dear <?=$data['user_name']?>,<br>
				  This is the confirmation of the your order #<?=$data['order_id']?> has been successfully placed on date <?=$data['order_date']?>.<br><br>
			  </div>
			  <table class="table table-striped table-advance table-hover" style="color:#000000">
				   <tbody>
					  <tr class="bg-primary">
						<th style="background-color:#34495e; color:#FFFFFF;">Sr. No.</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Item Name</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Cost</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Quantity</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Total</th>
					  </tr>
			  <?php
					$SQL="SELECT * FROM `order_item`,`meal` WHERE oi_product_id = meal_id AND oi_order_id = ".$_REQUEST['order_id'];
					$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
						$sr_no=1;
						$total_cost=0;
						while($data = mysqli_fetch_assoc($rs))
						{
							$total_cost += $data[oi_total]; 
					  ?>
					  <tr>
						<td><?=$sr_no++?></td>
						<td><?=$data[meal_title]?></td>
						<td><?=$data[oi_price_per_unit]?> Rs.</td>
						<td><?=$data[oi_cart_quantity]?></td>
						<td id="total_item_cost<?=$sr_no?>"><?=$data[oi_total]?>.00/-  Rs.</td>
					  </tr>
					  <?php } ?>
					  <tr>
						<td colspan="6" style="text-align:right; font-weight:bold; font-size:25px;"> Total Cost : <span id="total_cost"><?=$total_cost?>.00/-</span> Rs.</td>
					  </tr>
				   </tbody>
				</table>
			</form>
			</div>
			<div class="col-sm-3" style="margin-bottom:10px;">
				<div><img src="img/banner.jpg" style="width:250px;"></div>
			</div>
		</div>
	</div>
    <!--container end-->
<?php include_once("includes/footer.php"); ?>
