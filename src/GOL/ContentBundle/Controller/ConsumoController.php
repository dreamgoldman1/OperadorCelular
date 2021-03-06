<?php

namespace GOL\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GOL\ContentBundle\Entity\Consumo;

class ConsumoController extends Controller
{
    public function consumosAction(){
        return $this->render('GOLContentBundle:Consumo:consumos.html.twig', array(
            'consumos' => $this->getConsumosClientes(),
            'env' => $this->getEnv(),
        ));
    }
    
    public function detallesConsumosAction($noTelefono){
        return $this->render('GOLContentBundle:Consumo:detalles-consumos.html.twig', array(
            'no_telefono' => $noTelefono,
            'consumos' => $this->getDetallesConsumosCliente($noTelefono),
            'env' => $this->getEnv(),
        ));
    }
    
    public function getConsumosClientes(){
        $repository = $this->getDoctrine()->getManager();
        
        $query = $repository->createQuery(
            'SELECT sum(c.valorLlamada) total_consumo, c.noCelularOrigen, sum(c.tiempo) tiempo, sum(c.valorLlamada) valor
            FROM GOLContentBundle:Consumo c
            GROUP BY c.noCelularOrigen'
            );

        $totalConsumos = $query->getResult();        

        return $totalConsumos;
    }
    
    public function getDetallesConsumosCliente($noCelular){
        $filtros = array('noCelularOrigen' => $noCelular);
        $order = array('fechaLlamada' => 'DESC');
        $repository = $this->getDoctrine()->getManager();
        $consumosDB = $repository->getRepository('GOLContentBundle:Consumo')->findBy($filtros, $order);
        
        $consumos = array();
        foreach($consumosDB as $consumoDB){
            $consumos[] = array(
                'tiempo' => $consumoDB->getTiempo(),
                'valor_llamada' => $consumoDB->getValorLlamada(),
                'fecha_llamada' => $consumoDB->getFechaLlamada(),
                'no_celular_destino' => $consumoDB->getNoCelularDestino(),
            );
        }
        return $consumos;
    }
    
    /*
     * Funciones para los llamados del API
     */
    public function registrarLlamada($parametros, $em) {
        $consumo = new Consumo();
        $consumo->setNoCelularOrigen($parametros['no_celular_origen']);
        $consumo->setNoCelularDestino($parametros['no_celular_destino']);
        $consumo->setValorLlamada($parametros['valor_llamada']);
        $consumo->setFechaLlamada($parametros['fecha_llamada']);
        $consumo->setTiempo($parametros['tiempo']);

        //$em = $this->getDoctrine()->getEntityManager();
        $em->persist($consumo);
        $em->flush();
        
        return true;
    }
    
    public function getConsumoCliente($no_celular_origen,$repository) {
        $filtros = array('noCelularOrigen' => $no_celular_origen);
        $order = array('fechaLlamada' => 'DESC');
        //$repository = $this->getDoctrine()->getManager();
        $consumosDB = $repository->getRepository('GOLContentBundle:Consumo')->findBy($filtros, $order);
        
        $dataConsumos = array();
        foreach($consumosDB as $consumoDB){
            $dataConsumos[] = array(
                'id' => $consumoDB->getId(),
                'no_celular_origen' => $consumoDB->getNoCelularOrigen(),
                'no_celular_destino' => $consumoDB->getNoCelularDestino(),
                'valor_llamada' => $consumoDB->getValorLlamada(),
                'fecha_llamada' => $consumoDB->getFechaLlamada(),
                'tiempo' => $consumoDB->getTiempo(),
            );
        }
        return $dataConsumos;
    }
    
    public function getEnv() {
        global $kernel;
        return $kernel->getEnvironment() == "prod" ? "/" : "/app_dev.php/";
    }
}
