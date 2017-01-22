<?php

namespace GOL\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GOL\ContentBundle\Entity\Costo;

class AdministradorController extends Controller
{
    public function costosAction(Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $costo = new Costo();
            
            $fecha = date('Y-m-d H-i-s');
            $costo->setValorSegundo($request->get('valor'));
            $costo->setFecha($fecha);
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($costo);
            $em->flush();
        }
        return $this->render('GOLContentBundle:Administrador:costos.html.twig', array(
            'costos' => $this->getTodosLosCostos(),
            'env' => $this->getEnv(),
        ));
    }
    
    public function getTodosLosCostos() {
        $filtros = array();
        $order = array('fecha' => 'DESC');
        $repository = $this->getDoctrine()->getManager();
        $costosDB = $repository->getRepository('GOLContentBundle:Costo')->findBy($filtros,$order);
        
        $costos = array();
        $i=0;
        foreach ($costosDB as $costoDB){
            $i++;
            $estado = ($i == 1) ? 'Vigente' : 'Expidaro';
            $costos[] = array(
                'id' => $costoDB->getId(),
                'valor' => $costoDB->getValorSegundo(),
                'fecha' => $costoDB->getFecha(),
                'estado' => $estado,
            );
        }
        return $costos;
    }
    
    public function getCostoActual() {
        $filtros = array();
        $order = array('fecha' => 'DESC');
        $repository = \Symfony\Bundle\FrameworkBundle\Controller\Controller::getDoctrine()->getManager();
        $costoDB = $repository->getRepository('GOLContentBundle:Costo')->findOneBy($filtros,$order);
        
        $costoActual = array(
            'id' => $costoDB->getId(),
            'valor_segundo' => $costoDB->getValorSegundo(),
            'fecha' => $costoDB->getFecha(),
        );
        return $costoActual;
    }

    public function getEnv() {
        global $kernel;
        return $kernel->getEnvironment() == "prod" ? "/" : "/app_dev.php/";
    }
}
