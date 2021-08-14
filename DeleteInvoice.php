<?php
include "database/dbcn.php";


if ($_GET['op']=="delete")

{

    $delid=$_GET['id'];


    $que="DELETE FROM salesinvoice WHERE id='$delid' ";
    $rest=mysqli_query($conn,$que);


    if ($rest) {


        ?>

        <script>
            alert('Invoice deleted');
            window.location.href='Allinvoice.php';

        </script>
        <?php

    }

    else{
        ?>

        <script>

            alert('Invoice not deleted');
            window.location.href='Allinvoice.php';
        </script>
        <?php
    }}
?>







