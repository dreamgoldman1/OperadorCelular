<?php

namespace GOL\ContentBundle\Entity;

/**
 * Recarga
 */
class Recarga
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $noCelular;

    /**
     * @var string
     */
    private $valorRecarga;

    /**
     * @var string
     */
    private $fechaRecarga;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set noCelular
     *
     * @param string $noCelular
     *
     * @return Recarga
     */
    public function setNoCelular($noCelular)
    {
        $this->noCelular = $noCelular;

        return $this;
    }

    /**
     * Get noCelular
     *
     * @return string
     */
    public function getNoCelular()
    {
        return $this->noCelular;
    }

    /**
     * Set valorRecarga
     *
     * @param string $valorRecarga
     *
     * @return Recarga
     */
    public function setValorRecarga($valorRecarga)
    {
        $this->valorRecarga = $valorRecarga;

        return $this;
    }

    /**
     * Get valorRecarga
     *
     * @return string
     */
    public function getValorRecarga()
    {
        return $this->valorRecarga;
    }

    /**
     * Set fechaRecarga
     *
     * @param string $fechaRecarga
     *
     * @return Recarga
     */
    public function setFechaRecarga($fechaRecarga)
    {
        $this->fechaRecarga = $fechaRecarga;

        return $this;
    }

    /**
     * Get fechaRecarga
     *
     * @return string
     */
    public function getFechaRecarga()
    {
        return $this->fechaRecarga;
    }
}

