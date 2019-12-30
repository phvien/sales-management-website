<?php
    include_once("../session.php");
	include_once("producers.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
        $producer=get_producer($id);
    	$r=delete_producer($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete producer {$producer['pr_name']} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('Producer {$producer['pr_name']} cannot be deleted because there is a product in this producer!')</script>";
    	}
    	disconnect_db();
	}
	echo "<script>window.location='producer_list.php';</script>";
?>