
<?php



$host = "basededatosazure.mysql.database.azure.com";
$bd = "arc_technology";
$usuario = "Basededatosazure@basededatosazure";
$contraseña = "Jair300885";

try {
    //conexion a base de datos

    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña,
                array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));

                

} catch (Exception $ex) {
    //error de conexion
    echo $ex->getMessage();

}

?>

