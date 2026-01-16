<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[meal_id])
	{
		$SQL="SELECT * FROM `meal` WHERE meal_id = $_REQUEST[meal_id]";
		$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
		$data=mysqli_fetch_assoc($rs);
	}
?>
    <!--breadcrumbs start-->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <h1>Meals Management</h1>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->

    <!--container start-->
    <div class="registration-bg">
        <div class="container">
            <form action="lib/meal.php" enctype="multipart/form-data" method="post" class="form-signin wow fadeInUp" action="" style="max-width:800px">
                <h2 class="form-signin-heading">Add Meals</h2>
                <div class="login-wrap">          
				    <div class="form-group">
						<label for="pwd">Meals Name</label>
						<input type="text" class="form-control" placeholder="Meals Name" autofocus="" name="meal_title" id="meal_name" value="<?=$data[meal_title]?>">
				    </div>
                    <div class="form-group">
						<label for="pwd">Meals Category</label>
						<select name="meal_category_id" required class="form-control" placeholder="Select User" autofocus=""/>
							<?php echo get_new_optionlist("category","category_id","category_name",$data[meal_category_id]); ?>
						</select>
				    </div>
				     <div class="form-group">
						<label for="pwd">Meals Cost</label>
						<input type="text" class="form-control" placeholder="Meals Cost" autofocus="" name="meal_cost" id="meal_cost" value="<?=$data[meal_cost]?>">
				    </div>
				    <div class="form-group">
						<label for="pwd">Meals Picture</label>
						<input type="file" class="form-control" placeholder="Meals Mobile" autofocus="" name="meal_image" id="meal_image" value="<?=$data[meal_image]?>">
						<?php if(isset($data[meal_image]) && $data[meal_image] != "")  {?>
						<div><img src="<?=$SERVER_PATH.'uploads/'.$data[meal_image]?>" style="width: 100px"></div><br>
						<?php } ?>
				    </div>
				    <div class="form-group">
						<label for="pwd">Meal Item Description</label>
						<textarea class="form-control" rows="8" style="height:150px;" name="meal_description" ><?=$data[meal_description]?></textarea>
				    </div>
                    <button class="btn btn-lg btn-login btn-block" type="submit">Submit</button>
                </div>
                <input type="hidden" name="act" value="save_meal">
                <input type="hidden" name="avail_image" value="<?=$data[meal_image]?>">
				<input type="hidden" name="meal_id" value="<?=$data[meal_id]?>">
            </form>
        </div>
     </div>
    <!--container end-->
<?php include_once("includes/footer.php"); ?>
