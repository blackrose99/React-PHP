// db.php
<?php
$host = 'localhost';
$dbname = 'empleados'; // Modifica esto con el nombre de tu base de datos
$username = 'root';
$password = '0852'; // Modifica esto con tu contraseña de MySQL si la tienes configurada

//hola mundo 
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
