<?php
	session_start();
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_meal")
	{
		save_meal();
		exit;
	}
	if($_REQUEST[act]=="delete_meal")
	{
		delete_meal();
		exit;
	}
	###Code for save meal#####
	function save_meal()
	{
		global $con;
		$R=$_REQUEST;
		/////////////////////////////////////
		$image_name = $_FILES[meal_image][name];
		$location = $_FILES[meal_image][tmp_name];
		if($image_name!="")
		{
			move_uploaded_file($location,"../uploads/".$image_name);
		}
		else
		{
			$image_name = $R[avail_image];
		}
		//die;
		if($R[meal_id])
		{
			$statement = "UPDATE `meal` SET";
			$cond = "WHERE `meal_id` = '$R[meal_id]'";
			$msg = "Data Updated Successfully.";
			$condQuery = "";
		}
		else
		{
			$statement = "INSERT INTO `meal` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				`meal_title` = '$R[meal_title]', 
				`meal_category_id` = '$R[meal_category_id]', 
				`meal_cost` = '$R[meal_cost]', 
				`meal_description` = '$R[meal_description]', 
				`meal_image` = '$image_name'". 
				 $cond;
		$rs =mysqli_query($con,$SQL) or die(mysqli_error($con));
		header("Location:../report-meal.php?msg=$msg");
	}
#########Function for delete meal##########3
function delete_meal()
{
	global $con;
	$SQL="SELECT * FROM meal WHERE meal_id = $_REQUEST[meal_id]";
	$rs=mysqli_query($con,$SQL);
	$data=mysqli_fetch_assoc($rs);
	
	/////////Delete the record//////////
	$SQL="DELETE FROM meal WHERE meal_id = $_REQUEST[meal_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	
	//////////Delete the image///////////
	if($data[meal_image])
	{
		unlink("../uploads/".$data[meal_image]);
	}
	header("Location:../report-meal.php?msg=Deleted Successfully.");
}
?>
