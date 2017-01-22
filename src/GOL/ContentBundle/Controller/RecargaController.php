<?php

namespace GOL\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GOL\ContentBundle\Entity\Recarga;

class RecargaController extends Controller
{
    public function recargasAction(){
        return $this->render('GOLContentBundle:Recarga:recargas.html.twig', array(
            'recargas' => $this->getRecargasClientes(),
            'env' => $this->getEnv(),
        ));
    }
    
    public function detallesRecargasAction($noCelular){
        return $this->render('GOLContentBundle:Recarga:detalles-recargas.html.twig', array(
            'no_celular' => $noCelular,
            'recargas' => $this->getDetallesRecargasCliente($noCelular),
            'env' => $this->getEnv(),
        ));
    }
    
    public function getRecargasClientes(){
        $repository = $this->getDoctrine()->getManager();
        
        $query = $repository->createQuery(
            'SELECT sum(r.valorRecarga) total_recarga, r.noCelular
            FROM GOLContentBundle:Recarga r
            GROUP BY r.noCelular'
            );

        $totalRecargas = $query->getResult();        

        return $totalRecargas;
    }
    
    public function getDetallesRecargasCliente($noCelular){
        $filtros = array('noCelular' => $noCelular);
        $order = array('fechaRecarga' => 'DESC');
        $repository = $this->getDoctrine()->getManager();
        $recargasDB = $repository->getRepository('GOLContentBundle:Recarga')->findBy($filtros, $order);
        
        $recargas = array();
        foreach($recargasDB as $recargaDB){
            $recargas[] = array(
                'valor' => $recargaDB->getValorRecarga(),
                'fecha' => $recargaDB->getFechaRecarga(),
            );
        }
        return $recargas;
    }
    
    /*
     * Funciones para el API
     */
    public function registrarRecarga($parametros, $em) {
        $recarga = new Recarga();
        $recarga->setNoCelular($parametros['no_celular']);
        $recarga->setValorRecarga($parametros['valor_recarga']);
        $recarga->setFechaRecarga($parametros['fecha']);

        //$em = $this->getDoctrine()->getEntityManager();
        $em->persist($recarga);
        $em->flush();
        
        return true;
    }
    
    public function getRecargasCliente($no_celular, $repository) {
        $filtros = array('noCelular' => $no_celular);
        $order = array('fechaRecarga' => 'DESC');
        //$repository = $this->getDoctrine()->getManager();
        $recargasDB = $repository->getRepository('GOLContentBundle:Recarga')->findBy($filtros, $order);
        
        $dataRecargas = array();
        foreach($recargasDB as $recargaDB){
            $dataRecargas[] = array(
                'id' => $recargaDB->getId(),
                'no_celular' => $recargaDB->getNoCelular(),
                'valor_recarga' => $recargaDB->getValorRecarga(),
                'fecha_recarga' => $recargaDB->getFechaRecarga(),
            );
        }
        return $dataRecargas;
    }
    
    public function getEnv() {
        global $kernel;
        return $kernel->getEnvironment() == "prod" ? "/" : "/app_dev.php/";
    }
}
