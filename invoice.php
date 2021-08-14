<?php include "database/dbcn.php";?>
<!DOCTYPE html>
<html>
<head>
    <?php include "layout/layout.php"; ?>
    <style>

        .invoice-head td {
            padding: 0 8px;
        }
        .container {
            padding-top:30px;
        }
        .invoice-body{
            background-color:transparent;
        }
        .invoice-thank{
            margin-top: 60px;
            padding: 5px;
        }
        address{
            margin-top:15px;
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
    <div class="row">
        <div class="span4">
            <img src="images/waltonpi.jpg" class="img-rounded logo" style="width: 50px;height: 50px">
            <address>
                <strong>Walton Group</strong><br>

                Bashundhara R/A, Dhaka-1229.r<br>

            </address>
        </div>
        <div class="span4 well">
            <table class="invoice-head">
                <tbody>
                <?php

                if(isset($_GET['id'])) {

                $id=$_GET['id'];

                $sql="SELECT * FROM salesinvoice WHERE id='$id'";

                $result=mysqli_query($conn,$sql);
                if ($result) {
                while($row=$result->fetch_assoc()) {

                ?>
   <tr>
                    <td class="pull-right"><strong>Customer #</strong></td>
                    <td><?php echo $row['CustomerName']; ?></td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Invoice #</strong></td>
                    <td><?php echo $row['InvoiceNumber']; ?></td>
                </tr>
                <tr>
                    <td class="pull-right"><strong>Date</strong></td>
                    <td><?php echo $row['InvoiceDate']; ?></td>
                </tr>
                <?php }}} ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span8">
            <h2>Invoice</h2>
        </div>
    </div>
    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>UnitPrice</th>
                    <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php

                if(isset($_GET['id'])) {
                $total_price=0;
                $id=$_GET['id'];

                $sql="SELECT * FROM salesinvoicedetails WHERE SalesInvoiceid='$id'";

                $result=mysqli_query($conn,$sql);
                if ($result) {
                while($row=$result->fetch_assoc()) {

                ?>

                <tr>
                    <td><?php echo $row['ProductName']; ?></td>
                    <td><?php echo $row['Quantity']; ?></td>
                    <td><?php echo $row['UnitPrice']; ?></td>
                    <td><?php echo $row['Amount']; ?></td>
                </tr> <?php  }}}?>
                <tr><td colspan="4"></td></tr>
                <tr>
                    <?php

                    if(isset($_GET['id'])) {
                    $id=$_GET['id'];
                    $sql="SELECT * FROM salesinvoice WHERE id='$id'";
                    $result=mysqli_query($conn,$sql);
                    if ($result) {
                    while($row=$result->fetch_assoc()) {
                    ?>
                    <td colspan="2">&nbsp;</td>
                    <td><strong>Total</strong></td>
                    <td><strong><?php echo $row['TotalAmount']; ?></strong></td>
<?php }}}?>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span8 well invoice-thank">
            <h5 style="text-align:center;">Thank You!</h5>
        </div>
    </div>
    <div class="row">

        <div class="span3">
            <strong>Phone:</strong>008809606-555555
        </div>
        <div class="span3">
            <strong>Email:</strong> <a href="web@webivorous.com">jobs@waltonbd.com</a>
        </div>

    </div>
</div>
</body>
</html>
