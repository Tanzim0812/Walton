<?php
include "database/dbcn.php";

if (isset($_POST['submit'])){

    $CustomerName=($_POST['CustomerName']);
    $TotalAmount=0;

    //generate product Code randomly
    $str="12345ABCDEFGHIJabcePQRSTUVWXYZ";
    $str=str_shuffle($str);
    $str=substr($str, 0,6);



    $sql="INSERT INTO salesinvoice(InvoiceNumber,CustomerName,TotalAmount) VALUES ('$str','$CustomerName','$TotalAmount')";
    $res=mysqli_query($conn,$sql);

    if ($res) {
        echo "<script>
                 alert('Sales Invoice Created Successfully!! You will be redirected to the next page');window.location.href='invoiceDetails.php';
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
    <h2 class="jumbotron text-center" style="background-color: #bfbfbf">Sales Invoice</h2>
    <div class="row">
        <div class="col-sm-6">
            <div class="user_info">
                <div class="col-sm-12">
                    <h2>Add sale invoice</h2>
                </div>
                <div class="col-sm-12">
                    <form method="post">
                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label">Customer Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control cus_input" id="" name="CustomerName" placeholder="Customer name">
                            </div>
                        </div>




                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-success form-control cus_input" name="submit">Add</button>
                            </div>
                        </div>
                        <input type="reset" class="btn btn-dark" value="Reset" style="float: right;">

                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">

            <a href="invoiceDetails.php" class="btn btn-success" style="float: right; margin-bottom: 5px;color: white">Invoice Details</a>
            <h4> <u>All Invoices</u> </h4>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead class="bg-info">
                <tr>
                    <th>S.no</th>
                    <th>Invoice no.</th>
                    <th>Invoice Date</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $i=1;
                $sql="SELECT * FROM salesinvoice";
                $result=mysqli_query($conn,$sql);

                while($row =mysqli_fetch_array($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['InvoiceNumber']; ?></td>
                        <td><?php echo $row['InvoiceDate']; ?></td>
                        <td><?php echo $row['CustomerName']; ?> </td>
                        <td><?php echo $row['TotalAmount']; ?> ৳</td>
                        <td><a class="btn btn-info btn-xs" href="EditInvoice.php?id=<?php echo$row['id'];?>"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-danger btn-xs" href="DeleteInvoice.php?op=delete&id=<?php echo$row['id'];?>" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>
                    <?php $i++; }  ?>


                </tbody>
            </table>
        </div>

    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable').dataTable();

        $("[data-toggle=tooltip]").tooltip();

    } );

</script>
</body>
</html>