<?php
    include_once("../session.php");
	include_once("categories.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
        $category=get_category($id);
    	$r=delete_category($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete category {$category['ca_name']} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('Category {$category['ca_name']} cannot be deleted because there is a product in this category!')</script>";
    	}
    	disconnect_db();
	}
	echo "<script>window.location='category_list.php';</script>";
?>