<?php
include "database/dbcn.php";


if (isset($_POST['submit'])){

    $SalesInvoiceId=($_POST['SalesInvoiceId']);
    $ProductId=($_POST['ProductId']);
    $ProductName=($_POST['ProductName']);
    //generate product Code randomly
$Quantity=($_POST['Quantity']);
    $UnitPrice=($_POST['UnitPrice']);
    $str="1234567890";
    $str=str_shuffle($str);
    $str=substr($str, 0,4);

    $Amount= $Quantity * $UnitPrice;

    $sql="INSERT INTO salesinvoicedetails(SalesInvoiceId,LineNumber,ProductId,ProductName,Quantity,UnitPrice,Amount) VALUES ('$SalesInvoiceId','$str','$ProductId','$ProductName','$Quantity','$UnitPrice','$Amount')";
    $res=mysqli_query($conn,$sql);




        //$sqlUpdate= "UPDATE salesinvoice SET TotalAmount='' WHERE id='$SalesInvoiceId' ";//player=invoice...game=details
        $sqlUpdate="UPDATE salesinvoice c
                    INNER JOIN (
                      SELECT SalesInvoiceId, SUM(Amount) as total
                      FROM salesinvoicedetails
                      GROUP BY SalesInvoiceId
                    ) x ON c.id = x.SalesInvoiceId
                    SET c.TotalAmount = x.total";
        $ress=mysqli_query($conn,$sqlUpdate);

    if ($ress) {
        echo "<script>
                 alert('Successfully Added Invoice');window.location.href='Allinvoice.php';
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
    <h2 class="jumbotron text-center" style="background-color: #85adad">Sales Invoice Details</h2>
    <div class="row">
        <div class="col-sm-6">
            <div class="user_info">
                <div class="col-sm-12">
                    <h2>Add Sale Invoice Details</h2>
                </div>
                <div class="col-sm-12">
                    <form method="post">
                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label">Sales Invoice ID</label>
                            <div class="col-md-9">
                                <select id="SalesInvoiceId" class="form-control" name="SalesInvoiceId">
                                    <option class="alert-danger">Select</option>
                                    <?php
                                    $sql="SELECT * FROM salesinvoice ORDER BY id DESC";
                                    $result=mysqli_query($conn,$sql);
                                    while($row =mysqli_fetch_array($result)){ ?>
                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['InvoiceNumber']; ?> </option>
                                    <?php }?>

                                </select>
                              </div>
                        </div>

                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label">Product</label>
                            <div class="col-md-9">
                                <select class="form-control" name="ProductId" id="id" onchange="GetDetail(this.value)">
                                    <option class="alert-danger">Select</option>
                                    <?php
                                    $sql="SELECT * FROM products";
                                    $result=mysqli_query($conn,$sql);
                                    foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"> <?php echo $row['ProductName']; ?> </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label">Product Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control cus_input" id="ProductName" name="ProductName" placeholder="ProductName" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label">Unit Price</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control cus_input" id="SellingPrice" name="UnitPrice" placeholder="UnitPrice" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newName" class="col-md-3 col-form-label">Quantity</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control cus_input" id="Quantity" name="Quantity" placeholder="Quantity">
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
<div class="row">
            
            <h4> <u>All Invoices</u> </h4>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead class="bg-info">
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
//                $qu="SELECT SUM(Amount) FROM salesinvoicedetails GROUP BY SalesInvoiceId";
//                $rs= mysqli_query($conn,$qu);
                $i=1;
                $sql="SELECT * FROM salesinvoice";
                $result=mysqli_query($conn,$sql);

                while($row =mysqli_fetch_array($result))
                {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['InvoiceNumber'];?></td>
                        <td><?php echo $row['InvoiceDate']; ?></td>
                        <td><?php echo $row['CustomerName']; ?> </td>

                        <td><?php echo $row['TotalAmount']; ?> ৳</td>

                        <td><a class="btn btn-warning btn-xs" title="invoice" href="invoice.php?id=<?php echo$row['id'];?>"><span class="glyphicon glyphicon-edit"></span></a> <a class="btn btn-primary btn-xs" onclick="return confirm('Do you want to Edit it?');" href="EditInvoice.php?id=<?php echo$row['id'];?>"><span class="glyphicon glyphicon-edit"></span></a></td>
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
<script>
    function GetDetail(str){
        if (str.length == 0){
            document.getElementById("ProductName").value= "";
            document.getElementById("SellingPrice").value= "";
            return;
        }
        else{
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200){
                    var myobj = JSON.parse(this.responseText);
                    document.getElementById("ProductName").value=myobj[0];
                    document.getElementById("SellingPrice").value=myobj[1];
                }
            };
            xmlhttp.open("GET","name.php?id=" + str,true);
            xmlhttp.send();
        }
    }
</script>

</body>
</html>
