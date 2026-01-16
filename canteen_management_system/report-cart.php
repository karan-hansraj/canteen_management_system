<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `order_item`,`meal` WHERE oi_product_id = meal_id AND oi_order_id = ".$_SESSION['order_id'];
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
?>

<script>
$(document).on("click", ".delete-dialog", function () {
     var id = $(this).data('id');
	 $("#recordID").val( id );
});
function delete_record(category_id) {
	this.document.frm.act.value="delete_category";
	this.document.frm.submit();
}
function calculateCost(obj, sr_no, price) {
	var final_cost = obj.value * price;
	$('#total_item_cost'+sr_no).html(final_cost);
	calculate_total();
}
function calculate_total() {
	var total_record = $('#records').val();
	var total_cost = 0;
	for(i=2;i <= total_record; i++ ) {
		total_cost += parseInt($('#total_item_cost'+i).html());
	}
	$('#total_cost').html(total_cost+".00/-");
	$('#total_cost_final').val(total_cost);
}
</script>

    <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <h1>
              Cart Page
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
			<form name="frm" action="lib/cart.php" method="post">
			  <section class="panel">
				 
				  <table class="table table-striped table-advance table-hover" style="color:#000000">
				   <tbody>
					  <tr class="bg-primary">
						<th style="background-color:#34495e; color:#FFFFFF;">Sr. No.</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Item Name</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Cost</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Quantity</th>
						<th style="background-color:#34495e; color:#FFFFFF;">Total</th>
						<th style="background-color:#34495e; color:#FFFFFF;"><i class="icon_cogs"></i> Action</th>
					  </tr>
					  <?php 
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
						<td>
							<input type="text" value="<?=$data[oi_cart_quantity]?>" name="order_quantity[]" style="text-align:center; font-weight:bold;" onChange="calculateCost(this,<?=$sr_no?>,<?=$data[oi_price_per_unit]?>)">
						</td>
						<td id="total_item_cost<?=$sr_no?>"><?=$data[oi_total]?> Rs.</td>
						 <td>
						  <div class="btn-group">
                             <a class="delete-dialog btn btn-danger" href="lib/cart.php?act=delete_cart&oi_id=<?=$data[oi_id]?>">Delete</a>
						  </div>
						  </td>
					  </tr>
					  <?php } ?>
					  <tr>
						<td colspan="6" style="text-align:right; font-weight:bold; font-size:25px;"> Total Cost : <span id="total_cost"><?=$total_cost?>.00/- Rs.</span></td>
					  </tr>
				   </tbody>
				</table>
			  </section>
			  
			  <div style="margin:10px; text-align:right;"><input type="submit" value="Place Order" class="btn btn-lg btn-primary" style="width:200px"></div>
			  <input type="hidden" name="total_cost_final" id="total_cost_final" value="<?=$total_cost?>">
			  <input type="hidden" name="act" value="update_cart"/>
			  <input type="hidden" id="records" value="<?=$sr_no?>" />
			 </form>
		  </div>
	  </div>
	</div>

    <!--footer start-->
		<?php include_once("includes/footer.php"); ?>
    <!--small footer end-->
  </body>
</html>
