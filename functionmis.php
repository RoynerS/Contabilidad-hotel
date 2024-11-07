<?php
/**
 * Created by PhpStorm.
 * User: vishal
 * Date: 10/21/17
 * Time: 4:16 PM
 */

// Cambiar la ruta de inclusión para db.php
include_once "config/db.php";  // Asumiendo que db.php está en la carpeta config

// Agregar manejo de errores para la conexión
if (!$connection) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Agregar escape de caracteres para prevenir SQL injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM login WHERE username = '$username' AND password='$password'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($connection));
    }

    $userdetails = mysqli_fetch_assoc($result);

    if ($userdetails['username'] == 'manager') {
        header('Location: index.php?room_mang');
        exit();
    } else {
        header('Location: login.php');
        exit();
    }
}

if (isset($_POST['submit'])) {
    // ... código existente ...

    $query = "UPDATE staff SET emp_name='$first_name $last_name', 
              staff_type_id='$staff_type_id', shift_id='$shift_id', 
              id_card_type=$id_card_type, id_card_no='$id_card_no',
              address='$address', contact_no='$contact_no',
              joining_date='$joining_date', salary='$salary'
              WHERE emp_id=$emp_id";

    if (!mysqli_query($connection, $query)) {
        die("Error actualizando registro: " . mysqli_error($connection));
    }
    header('Location: index.php?staff_mang');
    exit();
}

if (isset($_GET['empid']) && $_GET['empid'] != "") {
    $emp_id = mysqli_real_escape_string($connection, $_GET['empid']);
    
    // Primero eliminar  registros relacionados en emp_history
    $deleteHistoryQuery = "DELETE FROM emp_history WHERE emp_id = $emp_id";
    if (!mysqli_query($connection, $deleteHistoryQuery)) {
        die("Error eliminando historial: " . mysqli_error($connection));
    }
    
    // Luego eliminar el empleado
    $deleteStaffQuery = "DELETE FROM staff WHERE emp_id = $emp_id";
    if (!mysqli_query($connection, $deleteStaffQuery)) {
        die("Error eliminando empleado: " . mysqli_error($connection));
    }
    
    header('Location: index.php?staff_mang');
    exit();
}

// Cerrar la conexión al final del script
mysqli_close($connection);
?>