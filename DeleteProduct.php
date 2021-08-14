<?php
include "database/dbcn.php";


if ($_GET['op']=="delete")

{

    $delid=$_GET['id'];


    $que="DELETE FROM products WHERE id='$delid' ";
    $rest=mysqli_query($conn,$que);


    if ($rest) {


        ?>

        <script>
            alert('Product deleted');
            window.location.href='index.php';

        </script>
        <?php

    }

    else{
        ?>

        <script>

            alert('Product not deleted');
            window.location.href='index.php';
        </script>
        <?php
    }}
?>







