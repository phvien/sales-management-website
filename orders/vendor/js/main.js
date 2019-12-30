$(document).ready(function() {

    function load_products() {

        $.ajax({
            url: "../orders/load-list-products.php",
            method: "GET",
            async: true,
            success: function(data) {
                $("#load-products").html(data)
            }
        });

        // if (window.XMLHttpRequest) {
        //     var xmlHttp = new XMLHttpRequest();
        // } else {
        //     var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");;
        // }

        // xmlHttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         document.getElementById("load-products").innerHTML = this.responseText;
        //     }
        // };

        // xmlHttp.open("GET", "../orders/load-list-products.php", true);
        // xmlHttp.send();
    }

    load_products();

    function load_items_cart() {
        var idOrders = $("#id-orders").val();

        if (window.XMLHttpRequest) {
            var xmlHttp = new XMLHttpRequest();
        } else {
            var xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlHttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("load-items-cart").innerHTML = this.responseText;
            }
        };

        xmlHttp.open("GET", "../orders/load-items-cart.php?idOrders=" + idOrders, true);
        xmlHttp.send();

    }

    load_items_cart();

    $("#load-products").on('click', '.btn-add', function() {
        var idOrders = $("#id-orders").val();
        var idProduct = $(this).data("code");
        var quantity = $(this).data("quantity");

        if (quantity == '0') {
            alert('Products out of stock!');
        } else {
            $.ajax({
                url: "../orders/add-item-cart.php",
                method: "GET",
                async: true,
                data: { idOrders: idOrders, idProduct: idProduct, quantity: quantity },
                success: function() {
                    load_items_cart();
                    load_products();
                }
            });
        }

    });

    function delete_item_cart(idOrders, idProduct, quantity) {
        console.log("idOrders: " + idOrders);
        console.log("idProduct: " + idProduct);
        console.log("quantity: " + quantity);

        $.ajax({
            url: "../orders/delete-item-cart.php",
            method: "GET",
            async: true,
            data: { idOrders: idOrders, idProduct: idProduct, quantity: quantity },
            success: function(data) {
                // alert(data);
                if (data == 'delete-empty-cart') {
                    location = '../orders/management.php';
                } else {
                    load_products();
                    load_items_cart();
                }

            }
        });

    }

    $("#load-items-cart").on('click', '.btn-delete', function() {
        var idProduct = $(this).data("code");
        var quantity = $(this).data("quantity");
        var idOrders = $("#id-orders").val();

        if (idOrders != null && idProduct != null && quantity != null) {
            delete_item_cart(idOrders, idProduct, quantity);
        } else {
            alert('Delete failed!');
        }
    });

    function update_quantity_product(idOrders, idProduct, quantityCurrent, quantityUpdate) {
        console.log("idOrders: " + idOrders);
        console.log("idProduct: " + idProduct);
        console.log("quantity-current: " + quantityCurrent);
        console.log("quantity-up: " + quantityUpdate);

        $.ajax({
            url: "../orders/update-quantity-product.php",
            method: "GET",
            async: true,
            data: { idOrders: idOrders, idProduct: idProduct, quantityCurrent: quantityCurrent, quantityUpdate: quantityUpdate },
            success: function(data) {
                // alert(data);
                load_products();
                load_items_cart();
            }
        });

    }

    $("#load-items-cart").on('click', '.btn-update', function() {
        var key = $(this).data("key") - 1;
        var idOrders = $("#id-orders").val();
        var idProduct = $(this).data("code");
        var quantityCurrent = $(this).data("quantity");
        var quantityUpdate = $(".quantity");

        if (quantityCurrent != quantityUpdate[key].value) {

            if (idOrders != null && idProduct != null && quantityCurrent != null) {
                update_quantity_product(idOrders, idProduct, quantityCurrent, quantityUpdate[key].value);
                // alert(quantityCurrent + " = " + quantityUpdate[key].value);

            } else {
                alert('Update failed!');
            }

        }

    });

    $("#btn-delete-order").click(function() {
        var idOrders = $("#id-orders").val();

        $.ajax({
            url: "../orders/delete-cart.php",
            method: 'GET',
            async: true,
            data: { idOrders: idOrders },
            success: function(data) {
                alert(data);
                location = '../orders/management.php';
            }
        });

    });

    $("#load-items-cart").on('click', '#pay', function() {
        pay();
    });


    function pay() {
        if (window.confirm("Do you want print a the bill ?")) {
            window.open("inhd.php");
        }
    }

});