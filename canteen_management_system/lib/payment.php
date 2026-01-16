<?php
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	
	if($_REQUEST[act]=="save_order")
	{
		save_order();
		exit;
	}
	if($_REQUEST[act]=="delete_order")
	{
		delete_order();
		exit;
	}
	if($_REQUEST[act]=="update_order_status")
	{
		update_order_status();
		exit;
	}
	
	###Code for save order#####
	function save_order()
	{
		print "<pre>";
		print_r($_SESSION);
		die;
		if(!$_SESSION['user_details']['user_id']) {
			echo "herel";
			header("location:../login.php?msg=Login to make the payment !!!");
			die;
		}
		global $con;
		$R=$_REQUEST;						
		if($R[order_id])
		{
			$statement = "UPDATE `order` SET";
			$cond = "WHERE `order_id` = '$R[order_id]'";
			$msg = "Data Updated Successfully.";
		}
		else
		{
			$statement = "INSERT INTO `order` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$R['order_user_id'] =  $_SESSION['user_details']['user_id'];
		$R['order_date'] = date("d F,Y h:i:s A");
		$R['order_status'] = "Confirmed";
		$SQL=   $statement." 
				`order_user_id` = '$R[order_user_id]', 
				`order_meal_id` = '$R[order_meal_id]', 
				`order_date` = '$R[order_date]', 
				`order_amount` = '$R[order_amount]', 
				`order_status` = '$R[order_status]'". 
				 $cond;
		$rs =mysqli_query($con,$SQL) or die(mysqli_error($con));
		$id = mysqli_insert_id($con);
		header("Location:../order-confirmation.php?msg=$msg&id=$id");
	}
#########Function for delete order##########3
function delete_order()
{	
	global $con;
	/////////Delete the record//////////
	$SQL="DELETE FROM order WHERE order_id = $_REQUEST[order_id]";
	mysqli_query($con,$SQL) or die(mysqli_error($con));
	header("Location:../report-order.php?msg=Deleted Successfully.");
}
?>
