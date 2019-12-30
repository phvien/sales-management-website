<?php
	include("config.php");
	include("function.php");

	if(isset($_GET['idsp'])){
    $idsp = $_GET['idsp'];
    settype($idsp,"int");  
     $xoasp = xoasp($conn, $idsp);
     header('Location:http://localhost/thuctap4/danhsachsanpham.php');

}else {
  $idsp ="";
}
if(isset($_GET["idspxoa"])){
	$idspxoa = $_GET["idspxoa"];

}else{
	$idspxoa = null;
}
 
 if (isset($_POST["submit_add"])) {
 if(isset($_POST['product_name'])){ $product_name = $_POST['product_name'];}
 if(isset($_POST['product_categorie'])){ $product_categorie = $_POST['product_categorie'];}
 if(isset($_POST['product_pr'])){ $product_pr = $_POST['product_pr'];}
 if(isset($_POST['available_quantity'])){ $available_quantity = $_POST['available_quantity'];}
 if(isset($_POST['product_price'])){ $product_price = $_POST['product_price'];}
 if(isset($_POST['product_description'])){ $product_description = $_POST['product_description'];}
 if(isset($_POST['product_name_fr'])){ $product_name_fr = $_POST['product_name_fr'];}
 $sql = "INSERT INTO PRODUCTS(PR_ID,CA_ID,PRO_NAME,PRO_DETAIL,PRO_PRICE,PRO_QUANTITY) values('$product_pr','$product_categorie','$product_name','$product_description','$product_price','$available_quantity')";
   if ($conn->query($sql) === TRUE) {
        echo "Thêm dữ liệu thành công";
        header('Location:http://localhost/thuctap4/danhsachsanpham.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
//Đóng database
	$conn->close();
// 

}
if (isset($_POST["submit_update"])) {
	 if(isset($_POST['product_name'])){ $product_name = $_POST['product_name'];}
	 if(isset($_POST['product_categorie'])){ $product_categorie = $_POST['product_categorie'];}
	 if(isset($_POST['product_pr'])){ $product_pr = $_POST['product_pr'];}
	 if(isset($_POST['available_quantity'])){ $available_quantity = $_POST['available_quantity'];}
	 if(isset($_POST['product_price'])){ $product_price = $_POST['product_price'];}
	 if(isset($_POST['product_description'])){ $product_description = $_POST['product_description'];}
	 // if(isset($_POST['product_name_fr'])){ $product_name_fr = $_POST['product_name_fr'];}
	 $sql = " UPDATE PRODUCTS
				SET PRO_ID = '$idspxoa', PR_ID = '$product_pr' ,CA_ID ='$product_categorie' ,PRO_NAME = '$product_name',PRO_DETAIL ='$product_description' ,PRO_PRICE = '$product_price' ,PRO_QUANTITY ='$available_quantity'
		    	WHERE PRO_ID = '$idspxoa'";
		    	if ($conn->query($sql) === TRUE) {
        echo "<script> alert('Đéo và đéo!'); </script>";
        echo "<script> window.location = 'Location:http://localhost/thuctap4/danhsachsanpham.php' </script>";

         // header('Location:http://localhost/thuctap4/danhsachsanpham.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
//Đóng database
	$conn->close();
// 
	}

 ?>
