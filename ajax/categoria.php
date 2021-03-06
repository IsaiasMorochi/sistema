<?php
/**
 * Created by PhpStorm.
 * User: isaias
 * Date: 27-07-17
 * Time: 05:45 PM
 */

require_once "../modelos/Categoria.php";


$categoria = new Categoria();

$idcategoria = isset($_POST["idcategoria"])?limpiarCadena($_POST["idcategoria"]):"";
$nombre = isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
$descripcion = isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
        if(empty($idcategoria)){
            $rspta = $categoria->insertar($nombre,$descripcion);
            echo $rspta?"Categoria registrada":"Categoria no se pudo registrar";
        }else{
            $rspta = $categoria->editar($idcategoria,$nombre,$descripcion);
            echo $rspta?"Categoria actualizada":"Categoria no se pudo actualizar";
        }
        break;
    case 'desactivar':
            $rspta = $categoria->desactivar($idcategoria);
            echo $rspta?"Categoria desactivada":"Categoria no se pudo desactivar";
        break;
    case "activar":
            $rspta = $categoria->activar($idcategoria);
            echo $rspta?"Categoria activada":"Categoria no se pudo activar";
        break;
    case "mostrar":
            $rspta = $categoria->mostrar($idcategoria);
            //codificar el resultado utilizando json
            echo json_encode($rspta);
        break;
    case "listar":
            $rspta = $categoria->listar();
            //vamos a declarar un array
            $data = Array();
            while($reg=$rspta->fetch_object()){
                $data[]=array(
                    "0"=>$reg->idcategoria,
                    "1"=>$reg->nombre,
                    "2"=>$reg->descripcion,
                    "3"=>$reg->condicion,
                );
            }
            $results = array(
                "sEcho"=>1, //Informacion para el dataTables
                "iTotalRecords"=>count($data), //enviamos el total regitros al dataTable
                "iTotalDisplayRecords"=>count($data),//enviamos el total registro a visualizar
                "aaData"=>$data
            );
        break;
}




?>