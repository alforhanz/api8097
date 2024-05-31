<?php
//MODELO PARA EL MODULO DE ORDENES DE COMPRAS
// namespace App\Models;

// use CodeIgniter\Model;
// use Exception;

// class WMS_sp_getOrdenesCompras_Model extends Model
// {
//     //------------------------------------------------------------
//     //  LISTA LAS ORDENES DE COMPRA EN TRANSITO SIN PROCESAR
//     //------------------------------------------------------------
//     public function sp_getOrdenesdeCompras($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden)
//     {
//         try {
//             $db = db_connect();
//             $sql = "{CALL [CLSA].[WMS_sp_getOrdenesCompras] (?,?,?,?,?,?)}";
//             $params = array($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden);
//             $query = $db->query($sql, $params)->getResult();
//             return $query;
//         } catch (Exception $e) {
//             throw new Exception('Error al ejecutar el procedimiento almacenado: ' . $e->getMessage());
//         }
//     }


//       //------------------------------------------------------------
//     //  OBTIENE EL DETALLE DE UNA ORDEN DE COMPRA
//     //--------------------------------------------------------------
//     public function sp_getOrdenesdeCompraList($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden)
//     {
//         try {
//             $db = db_connect();
//             $sql = "{CALL [CLSA].[WMS_sp_getOrdenesCompras] (?,?,?,?,?,?)}";
//             $params = array($pSistema, $pUsuario, $pOpcion,$pBodega,$pEstado, $pOrden);
//             $query = $db->query($sql, $params)->getResult();
//             return $query;
//         } catch (Exception $e) {
//             throw new Exception('Error al ejecutar el procedimiento almacenado: ' . $e->getMessage());
//         }
//     }


//     //------------------------------------------------------------
//     //  GUARDADO PARCIAL Y PROCESADO DE LA LECTURA DE LA ORDEN DE COMPRAS
//     //------------------------------------------------------------
   
//      public function spGuardaOrdenCompraLectura($pSistema=null, $pUsuario=null, $pOpcion=null, $pModulo=null, $pConsecutivo=null, $pArticulo=null, $pLineaConsec=null, $pLineaConteo=null,$pEstado=null, $pBodega=null  )
//     {
//       try {
//           $db = db_connect();          
//           $params = array($pSistema, $pUsuario, $pOpcion, $pModulo, $pConsecutivo, $pArticulo, $pLineaConsec, $pLineaConteo, $pEstado, $pBodega);          
//           $sql = "{CALL [CLSA].[WMS_sp_InsertUpdate_ControlEntrega_OrdenCompra] ?,?,?,?,?,?,?,?,?,?}";
//           $query = $db->query($sql,$params)->getResult();
//           return $query;
//           $query->free_result();
//           $db->close();
//       } catch (Exception $e) {
//           die($e->getMessage());
//           return "";
//       }
//     }
// }