<?php
include_once "config/db.php";
session_start();
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $userQuery = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($connection, $userQuery);
    $user = mysqli_fetch_assoc($result);
}else{
    header('Location:login.php');
}
include_once "includes/header.php";
// Pasar $user como variable
include "includes/sidebar.php"; 

// ... resto del código

if (isset($_GET['room_mang'])){
    include_once "pages/room_mang.php";
}
elseif (isset($_GET['dashboard'])){
    include_once "pages/dashboard.php";
}
elseif (isset($_GET['reservation'])){
    include_once "pages/reservation.php";
}
elseif (isset($_GET['staff_mang'])){
    include_once "pages/staff_mang.php";
}
elseif (isset($_GET['add_emp'])){
    include_once "pages/add_emp.php";
}
elseif (isset($_GET['complain'])){
    include_once "pages/complain.php";
}
elseif (isset($_GET['statistics'])){
    include_once "pages/statistics.php";
}
elseif (isset($_GET['emp_history'])){
    include_once "pages/emp_history.php";
}
else{
    include_once "pages/room_mang.php";
}

include_once "includes/footer.php";

