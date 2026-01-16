<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `meal`,`category` WHERE meal_category_id = category_id";
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
?>

<script>
$(document).on("click", ".delete-dialog", function () {
     var id = $(this).data('id');
	 $("#recordID").val( id );
});
function delete_record(meal_id)
{
	this.document.frm.act.value="delete_meal";
	this.document.frm.submit();
}
function goToPage(meal_id,meal_cost)
{
	location.href = "lib/cart.php?act=save_item&meal_id="+meal_id+"&cost="+meal_cost;
}
</script>

    <!--breadcrumbs start-->
    <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-sm-4">
            <h1>
              Our Meals
            </h1>
          </div>
        </div>
      </div>
    </div>
    <!--breadcrumbs end-->

 <div class="container" style="margin-bottom:20px; text-align:center">
		 <?php if($_REQUEST['msg']) { ?>
		  <div class="alert alert-success fade in" style="margin:10px;">
			  <strong><?=$_REQUEST['msg']?></strong>
		  </div>
		  <?php } ?>
		<div class="row">
		  <?php 
			$sr_no=1;
			while($data = mysqli_fetch_assoc($rs))
			{
		  ?>
			<div class="col" style="width:250px; float:left; padding:8px; text-align:center; border:1px solid #cccccc; margin:10px">
				<h3><?=$data[meal_title]?></h3>
				<img src="<?=$SERVER_PATH.'uploads/'.$data[meal_image]?>" style="height:250px; width:240px; margin-botton:50px">
				<div><b>Category : </b><?=$data[category_name]?></div>
				<div><?=nl2br($data[meal_description])?></div>
				<div style="font-size:20px; font-weight:bold; color: #34495e"><b>Cost : </b><?=$data[meal_cost]?> Rs.</div>
				<button class="btn btn-lg btn-primary btn-block" type="button" onClick="goToPage(<?=$data[meal_id]?>,<?=$data[meal_cost]?>)">Add to Cart</button>
			</div>
		  <?php } ?>
	  </div>
	</div>

    <!--footer start-->
		<?php include_once("includes/footer.php"); ?>
    <!--small footer end-->
  </body>
</html>
