<?php

namespace GOL\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GOL\ContentBundle\Controller\RecargaController;
use GOL\ContentBundle\Controller\ConsumoController;
use GOL\ContentBundle\Controller\AdministradorController;
use GOL\ContentBundle\Controller\SaldoController;

class ApiController extends Controller
{
    public function apiRecargaAction(Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $no_celular = $request->get('no_celular');
            $valor_recarga = $request->get('valor_recarga');
            $fecha = date('Y-m-d H:i:s');
            
            $parametros = array(
                'no_celular' => $no_celular,
                'valor_recarga' => $valor_recarga,
                'fecha' => $fecha,
            );
            $recarga = RecargaController::registrarRecarga($parametros);
            if ($recarga){
                $respuesta = array(
                    'codMensaje' => 0,
                    'Mensaje' => "Recarga efectuada de forma exitosa",
                    'Estado' => 'Ok',
                );
            }else{
                $respuesta = array(
                    'codMensaje' => 002,
                    'Mensaje' => "Error al momento de realizar la recarga",
                    'Estado' => 'Error',
                );
            }
        }else{
            $respuesta = array(
                'codMensaje' => 001,
                'Mensaje' => "El método con que se envían los datos no corresponde. Debe ser POST",
                'Estado' => 'Error',
            );
        }
        $response = new Response(json_encode($respuesta));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    function apiGetRecargaClienteAction(Request $request) {
        if ($request->getMethod() == 'POST'){
            $recargas = RecargaController::getRecargasCliente($request->get('no_celular'));
            $respuesta = array(
                    'codMensaje' => 0,
                    'Mensaje' => "Consulta exitosa",
                    'Data' => $recargas,
                    'Estado' => 'Ok',
                );
        }else{
            $respuesta = array(
                'codMensaje' => 001,
                'Mensaje' => "El método con que se envían los datos no corresponde. Debe ser POST",
                'Estado' => 'Error',
            );
        }
        $response = new Response(json_encode($respuesta));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    public function apiRegistrarLlamadaAction(Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $no_celular_origen = $request->get('no_celular_origen');
            $no_celular_destino = $request->get('no_celular_destino');
            $costoActual = AdministradorController::getCostoActual();
            $valor_llamada = $request->get('tiempo') * $costoActual['valor_segundo'];  // se debe consultar el valor del segundo de la base de datos
            $tiempo = $request->get('tiempo');
            $fecha_llamada = date('Y-m-d H:i:s');
            $parametros = array(
                'no_celular_origen' => $no_celular_origen,
                'no_celular_destino' => $no_celular_destino,
                'valor_llamada' => $valor_llamada,
                'fecha_llamada' => $fecha_llamada,
                'tiempo' => $tiempo,
            );
            $llamada = ConsumoController::registrarLlamada($parametros);
            
            if ($llamada){
                $respuesta = array(
                    'codMensaje' => 0,
                    'Mensaje' => "Llamada exitosa",
                    'Estado' => 'Ok',
                );
            }else{
                $respuesta = array(
                    'codMensaje' => 002,
                    'Mensaje' => "Error al momento de realizar la llamada",
                    'Estado' => 'Error',
                );
            }
        }else{
            $respuesta = array(
                'codMensaje' => 001,
                'Mensaje' => "El método con que se envían los datos no corresponde. Debe ser POST",
                'Estado' => 'Error',
            );
        }
        $response = new Response(json_encode($respuesta));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    function apiGetConsumoClienteAction(Request $request) {
        if ($request->getMethod() == 'POST'){
            $consumos = ConsumoController::getConsumoCliente($request->get('no_celular_origen'));
            $respuesta = array(
                    'codMensaje' => 0,
                    'Mensaje' => "Consulta exitosa",
                    'Data' => $consumos,
                    'Estado' => 'Ok',
                );
        }else{
            $respuesta = array(
                'codMensaje' => 001,
                'Mensaje' => "El método con que se envían los datos no corresponde. Debe ser POST",
                'Estado' => 'Error',
            );
        }
        $response = new Response(json_encode($respuesta));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    function apiGetSaldoClienteAction(Request $request){
        if ($request->getMethod() == 'POST'){
            $no_celular = $request->get('no_celular');
            $saldo = SaldoController::getSaldoCliente($no_celular);
            
            $costoActual = AdministradorController::getCostoActual();
            
            $saldo['no_celular'] = $no_celular;
            $saldo['costo_actual'] = $costoActual['valor_segundo'];
            $saldo['saldo'] = $saldo['total_recargas'] - $saldo['total_consumos'];
            $saldo['saldo_tiempo'] = intdiv($saldo['saldo'], $costoActual['valor_segundo']);
            
            $respuesta = array(
                'codMensaje' => 0,
                'Mensaje' => "Consulta exitosa",
                'Data' => $saldo,
                'Estado' => 'Ok',
            );
        }else{
            $respuesta = array(
                'codMensaje' => 001,
                'Mensaje' => "El método con que se envían los datos no corresponde. Debe ser POST",
                'Estado' => 'Error',
            );
        }
        $response = new Response(json_encode($respuesta));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    
    function apiGetSaldoDisponibleAction($no_celular) {
        $saldo = SaldoController::getSaldoCliente($no_celular);
        $costoActual = AdministradorController::getCostoActual();
        
        $saldo['saldo'] = $saldo['total_recargas'] - $saldo['total_consumos'];
        
        $saldoDisponible = array(
            'saldo' => $saldo,
            'costo' => $costoActual,
        );
        
        $response = new Response(json_encode($saldoDisponible));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*'); // Para permitir el acceso cross-domain

        return $response;
    }
}
