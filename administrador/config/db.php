
<?php



$host = "localhost";
$bd = "arc_technology";
$usuario = "root";
$contraseña = "";

try {
    //conexion a base de datos

    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña,
                array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

                

} catch (Exception $ex) {
    //error de conexion
    echo $ex->getMessage();

}

?>

