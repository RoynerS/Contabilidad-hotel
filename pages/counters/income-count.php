<?php 
    include './config/db.php';
    $sql = "SELECT SUM(total_price) FROM booking WHERE payment_status = '1'";
    $amountsum = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $row_amountsum = mysqli_fetch_assoc($amountsum);
    echo $row_amountsum['SUM(total_price)'];
?>