<?php
    include_once("../session.php");
	include_once("customers.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
        $customer=get_customer($id);
    	$r=delete_customer($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete customer {$customer['cus_fullname']} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('Customer {$customer['cus_fullname']} cannot be deleted because there is a order in this customer!')</script>";
    	}
    	disconnect_db();
	}	
	echo "<script>window.location='customer_list.php';</script>";
?>