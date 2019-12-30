<?php
    include_once("../session.php");
    include_once('../products/products.php');
    if (isset($_POST['addquantity']))
    {
        $id=$_POST['id'];
        $quantity=$_POST['quantity'];
        $r=add_quantity($id, $quantity);
        if ($r)
        {
            echo "<script>alert('Add quantity for product successfully!')</script>";
        }
        else
        {
            echo "<script>alert('Add quantity for product failed!')</script>";
        }
        echo "<script>window.location='product_list.php';</script>";
    }
    $products=get_all_products();
    foreach ($products as $product)
    {
?>
    <!-- Add Quantity product Modal-->
    <div class="modal fade" <?php echo "id='addQuantity{$product['pro_id']}Modal'"; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post">  
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add quantity for product</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <!-- <td>ID</td> -->
                                <!-- <td> -->
                                    <input type="hidden" name="id" class="form-control" readonly value="<?php echo $product['pro_id']; ?>">
                                <!-- </td> -->
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" class="form-control" name="name" maxlength="100" required  value="<?php echo $product['pro_name']; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>
                                    <input type="number" name="quantity" class="form-control" required min="1">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" name="addquantity" value="Add">   
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    }
?>
