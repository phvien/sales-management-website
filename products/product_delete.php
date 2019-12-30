<?php
    include_once("../session.php");
	include_once("products.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
        $product=get_product($id);
    	$r=delete_product($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete product {$product['pro_name']} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('Product {$product['pro_name']} cannot be deleted because there is a order in this product!')</script>";
    	}
    	disconnect_db();
	}
	echo "<script>window.location='product_list.php';</script>";
?>