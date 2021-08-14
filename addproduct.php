<?php
include "database/dbcn.php";

if (isset($_POST['submit'])){

    $ProductName=($_POST['ProductName']);
    $SellingPrice=($_POST['SellingPrice']);

    //generate product Code randomly
    $str="12345ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $str=str_shuffle($str);
    $str=substr($str, 0,6);



    $sql="INSERT INTO products(ProductCode,ProductName,SellingPrice) VALUES ('$str','$ProductName','$SellingPrice')";
    $res=mysqli_query($conn,$sql);

    if ($res) {
        echo "<script>
                 alert('Product is Successfully Added');window.location.href='index.php';
            </script>";
    }
    else{
        echo "<script>alert('Problem')</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <?php include "layout/layout.php"; ?>
    <style>

    .dash_cus{
        margin-top:150px;
        background:#ebeff2;
        padding:50px 0px;
    }
    .user_info{
        background:#fff;
        padding:20px 0px;
        box-shadow:0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        overflow:hidden;
    }
    .user_info h2 {
        font-size: 24px;
        margin-top: 0;
        font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif!important;
        padding-bottom: 5px;
        border-bottom: 1px solid #ebeff2;
    }
    input.form-control.cus_input:focus {
        box-shadow: none;
    }

    input.form-control.cus_input {
        border-radius: 0;
        /* border-color: rebeccapurple; */
    }
    label.col-md-3.col-form-label {
        font-size: 16px;
        font-weight: 400;
        font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif!important;
    }
    input.form-control.cus_input_btn {
        background: #008400;
        color: #fff;
        border-radius: 0;
        border-color: #008400;
        font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif!important;
    }
    input.form-control.cus_input_btn:hover{
        box-shadow:0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }
    p.membership_detail span {
        font-weight: 300;
        margin-left: 15px;
    }
    p.membership_detail {
        font-size: 16px;
        font-weight: 600;
        font-family: 'Montserrat',Helvetica,Arial,Lucida,sans-serif!important;
        border-bottom: 1px solid #ebeff2;
    }
</style>

</head>
<body>
<section class="navigation">
    <div class="nav-container">
        <div class="brand">
            <a href="#!"><img src="images/waltonpi.jpg" style="width: 50px;height: 50px"> Walton</a>
        </div>
        <nav>
            <div class="nav-mobile"><a id="navbar-toggle" href=""><span></span></a></div>
            <ul class="nav-list">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="salesinvoice.php">Sales Invoice</a>
                </li>
                <li>
                    <a href="invoiceDetails.php">Sales Invoice Details</a>
                </li>


                <li>
                    <a href="https://waltonbd.com/contact">Contact</a>
                </li>
            </ul>
        </nav>
    </div>
</section>
    <div class="container">
        <h2 class="jumbotron text-center" style="background-color: lightgreen">Add Product</h2>
        <div class="row">
            <div class="col-sm-8">
                <div class="user_info">
                    <div class="col-sm-12">
                        <h2>Product Info</h2>
                    </div>
                    <div class="col-sm-12">
                        <form method="post">
                            <div class="form-group row">
                                <label for="newName" class="col-md-3 col-form-label">Product Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control cus_input" id="" name="ProductName" placeholder="Product name">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newName" class="col-md-3 col-form-label">Selling Price</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control cus_input" id="" name="SellingPrice" placeholder="Price" min="1">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="newName" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-success form-control cus_input" name="submit">Submit</button>
                                </div>
                            </div>
                            <input type="reset" class="btn btn-dark" value="Reset" style="float: right;">

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <h4> <u>Note</u> </h4>Your Product Code will be generate automatically.
            </div>

        </div>
    </div>
</div>


</body>
</html>