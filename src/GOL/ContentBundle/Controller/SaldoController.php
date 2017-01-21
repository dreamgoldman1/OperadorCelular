<?php

namespace GOL\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SaldoController extends Controller
{
    public function getSaldoCliente($no_celular) {
        
        
        echo "<pre>";
        print_r("Entra en el llamado de la funcion");
        die;
        
        
        
        $repository = $this->getDoctrine()->getManager();
        
        $query = $repository->createQuery(
            'SELECT sum(r.valorRecarga) total_recarga
            FROM GOLContentBundle:Recarga r
            WHERE r.noCelular = :no_celular'
            )->setParameter('no_celular', $no_celular);

        $totalRecargas = $query->getResult();
        
        $query = $repository->createQuery(
            'SELECT sum(c.valorLlamada) total_consumo
            FROM GOLContentBundle:Consumo c
            WHERE c.noCelularOrigen = :no_celular'
            )->setParameter('no_celular', $no_celular);

        $totalConsumos = $query->getResult();
        return array('total_recargas' => $totalRecargas[0]['total_recarga'], 'total_consumos' => $totalConsumos[0]['total_consumo']);
    }
}
