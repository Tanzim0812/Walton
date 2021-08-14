<?php

include "database/dbcn.php";

?>

<!DOCTYPE html>
<html>
<head>
    <?php include "layout/layout.php"; ?>

    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        tr:nth-child(even) {background: #d6d6c2}

        /*datatable */

        .btn {
            display: inline-block;
            padding: 6px 12px !important;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .btn-primary {
            color: #fff !important;
            background: #428bca !important;
            border-color: #357ebd !important;
            box-shadow:none !important;
        }
        .btn-danger {
            color: #fff !important;
            background: #d9534f !important;
            border-color: #d9534f !important;
            box-shadow:none !important;
        }
        /*datatable end */
    </style>

<body style="background-color: ghostwhite">
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
    <div class="row">
        <h4 class="jumbotron text-center" style="background-color: #e6917f;font-family:verdana;">All Invoice Details of Walton</h4>

    </div>



    <a href="index.php" class="btn btn-primary" style="float: right; margin-bottom: 5px;margin-right: 12px;color: white;font-size: 14px"><i class="fas fa-home"> Return to Home </i></a>
    <div class="col-md-12">

        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead style="background-color: #d9534f;color: white">
            <tr>
                <th>S.no</th>
                <th>Sales Invoice ID.</th>
                <th>Invoice Date</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $qu="SELECT SUM(Amount) FROM salesinvoicedetails GROUP BY SalesInvoiceId";
            $rs= mysqli_query($conn,$qu);
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
                    <td><a class="btn btn-danger btn-xs" href="DeleteInvoice.php?op=delete&id=<?php echo$row['id'];?>" onclick="return confirm('Are you sure you want to delete this item?');"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <?php $i++; }  ?>

            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input class="form-control " type="text" placeholder="Tiger Nixon">
                </div>
                <div class="form-group">

                    <input class="form-control " type="text" placeholder="System Architect">
                </div>
                <div class="form-group">


                    <input class="form-control " type="text" placeholder="Edinburgh">

                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    $(document).ready(function() {
        $('#datatable').dataTable();

        $("[data-toggle=tooltip]").tooltip();

    } );

</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>
