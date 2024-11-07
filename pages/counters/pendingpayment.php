<?php 
try {
    // Incluir archivo de conexión
    include './config/db.php';
    
    // Consulta SQL con alias para facilitar el acceso
    $sql = "SELECT SUM(total_price) as total FROM booking WHERE payment_status = '1'";
    
    // Ejecutar consulta
    $amountsum = mysqli_query($connection, $sql);
    
    if (!$amountsum) {
        throw new Exception("Error en la consulta: " . mysqli_error($connection));
    }
    
    // Obtener resultado
    $row = mysqli_fetch_assoc($amountsum);
    
    // Mostrar el total, si es NULL mostrar 0
    echo $row['total'] ?? '0';

} catch (Exception $e) {
    // Manejo de errores
    error_log($e->getMessage());
    echo '0'; // Valor por defecto en caso de error
} finally {
    // Cerrar el resultado si existe
    if (isset($amountsum)) {
        mysqli_free_result($amountsum);
    }
}
?>