<?php 

include("administrador/config/db.php");


$mensaje="";

if(isset($_POST['btnAccion'])){


    switch($_POST['btnAccion']){

    case 'Agregar':

        if (is_numeric(openssl_decrypt($_POST['id'],COD,KEY ))){

            $ID=openssl_decrypt($_POST['id'],COD,KEY );
           

        }else{

            $mensaje.=" Uppss.... ID incorrecto";
             }

            if (is_string(openssl_decrypt($_POST['referencia'],COD,KEY ))){

                $REFERENCIA=openssl_decrypt($_POST['referencia'],COD,KEY );
               
    
            }else{
    
                $mensaje.=" Uppss.... Algo pasa con la referencia ";
                }

                if (is_numeric(openssl_decrypt($_POST['precio'],COD,KEY ))){

                    $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY );
                    
        
                }else{
        
                    $mensaje.=" Uppss.... Algo pasa con el precio";
                    }

                    if (is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY ))){

                        $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY );
                        
            
                    }else{
            
                        $mensaje.=" Uppss.... Algo pasa con la cantidad";
                        }



                     if(!isset($_SESSION['CARRITO']))   {

                        $productos=array(
                        'ID'=>$ID,
                        'REFERENCIA'=>$REFERENCIA,
                        'PRECIO'=>$PRECIO,
                        'CANTIDAD'=>$CANTIDAD
                        );
                        
                        $_SESSION['CARRITO'][0]=$productos;

                        $mensaje.="Producto Agregado al Carrito...";

                     }else{

                        $idPrpductos=array_column($_SESSION['CARRITO'],"ID");
                       
                        if(in_array($ID,$idPrpductos)){

                            echo "<script>alert('El producto ya ha sido seleccionado...');</script>";

                        }else{

                            $numeroProductos=count($_SESSION['CARRITO']);
                            $productos=array(
                            'ID'=>$ID,
                            'REFERENCIA'=>$REFERENCIA,
                            'PRECIO'=>$PRECIO,
                            'CANTIDAD'=>$CANTIDAD
                            );
                            
                            $_SESSION['CARRITO'][$numeroProductos]=$productos;
                            $mensaje.="Producto Agregado al Carrito...";
                        }
                     }

                     
        break;

        case 'Eliminar':
            if (is_numeric(openssl_decrypt($_POST['id'],COD,KEY ))){

                $ID=openssl_decrypt($_POST['id'],COD,KEY );
                
                foreach ($_SESSION['CARRITO'] as $indice=>$producto) {

                    if($producto['ID']==$ID){

                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado....');</script>";

                    }

                    
                }
                
            }
                
                header('Location:mostrarCarrito.php');
        break;
}
}

?>