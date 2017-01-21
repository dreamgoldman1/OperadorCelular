<?php

namespace GOL\ContentBundle\Entity;

/**
 * Consumo
 */
class Consumo
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $noCelularOrigen;
    
    /**
     * @var string
     */
    private $noCelularDestino;
    
    /**
     * @var string
     */
    private $valorLlamada;
    
    /**
     * @var string
     */
    private $tiempo;
    
    /**
     * @var string
     */
    private $fechaLlamada;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    function getNoCelularOrigen() {
        return $this->noCelularOrigen;
    }

    function getNoCelularDestino() {
        return $this->noCelularDestino;
    }

    function getValorLlamada() {
        return $this->valorLlamada;
    }

    function getTiempo() {
        return $this->tiempo;
    }

    function getFechaLlamada() {
        return $this->fechaLlamada;
    }

    function setNoCelularOrigen($noCelularOrigen) {
        $this->noCelularOrigen = $noCelularOrigen;
    }

    function setNoCelularDestino($noCelularDestino) {
        $this->noCelularDestino = $noCelularDestino;
    }

    function setValorLlamada($valorLlamada) {
        $this->valorLlamada = $valorLlamada;
    }

    function setTiempo($tiempo) {
        $this->tiempo = $tiempo;
    }

    function setFechaLlamada($fechaLlamada) {
        $this->fechaLlamada = $fechaLlamada;
    }


}