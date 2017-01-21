<?php

namespace GOL\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GOL\ContentBundle\Entity\Cliente;

class ClienteController extends Controller
{
    public function clientesAction()
    {
        $clientes = $this->getTodosLosClientes();
        return $this->render('GOLContentBundle:Cliente:clientes.html.twig', array(
            'clientes' => $clientes,
            'env' => $this->getEnv(),
        ));
    }
    
    // Validar en base de datos que el numero de celular no exista
    public function nuevoClienteAction(Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $cliente = new Cliente();
            
            $fecha = date('Y-m-d H:i:s');
            $cliente->setNoCelular($request->get('no_celular'));
            $cliente->setFecha($fecha);
            $cliente->setEstado($request->get('estado'));
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($cliente);
            $em->flush();
            
            return $this->redirect($this->getEnv() . 'clientes');
        }
        return $this->render('GOLContentBundle:Cliente:nuevo-cliente.html.twig', array(
            'env' => $this->getEnv(),
        ));
    }
    
    // Validar en base de datos que el numero de celular no exista
    public function editarClienteAction($idCliente, Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $filtros = array('id' => $idCliente);
            $repository = $this->getDoctrine()->getManager();
            $clienteDB = $repository->getRepository('GOLContentBundle:Cliente')->findOneBy($filtros);
            
            $clienteDB->setEstado($request->get('estado'));
            $repository->flush();
            
            return $this->redirect($this->getEnv() . 'clientes');
        }
        
        $filtros = array('id' => $idCliente);
        $repository = $this->getDoctrine()->getManager();
        $clienteDB = $repository->getRepository('GOLContentBundle:Cliente')->findOneBy($filtros);
        
        $dataCliente = array(
            'id' => $clienteDB->getId(),
            'no_celular' => $clienteDB->getNoCelular(),
            'fecha' => $clienteDB->getFecha(),
            'estado' => $clienteDB->getEstado(),
        );
        
        return $this->render('GOLContentBundle:Cliente:editar-cliente.html.twig', array(
            'dataCliente' => $dataCliente,
            'env' => $this->getEnv(),
        ));
    }

    // Se debe conectar a una base de datos para obtener la respuesta
    public function getTodosLosClientes(){
        $filtros = array();
        $order = array('fecha' => 'DESC');
        $repository = $this->getDoctrine()->getManager();
        $clientesDB = $repository->getRepository('GOLContentBundle:Cliente')->findBy($filtros,$order);
        
        $clientes = array();
        foreach ($clientesDB as $clienteDB){
            $clientes[] = array(
                'id' => $clienteDB->getId(),
                'no_celular' => $clienteDB->getNoCelular(),
                'fecha' => $clienteDB->getFecha(),
                'estado' => $clienteDB->getEstado(),
            );
        }
        return $clientes;
    }
    
    public function getEnv() {
        global $kernel;
        return $kernel->getEnvironment() == "prod" ? "/" : "/app_dev.php/";
    }
}
