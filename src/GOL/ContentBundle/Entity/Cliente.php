<?php

namespace GOL\ContentBundle\Entity;

/**
 * Cliente
 */
class Cliente
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
    private $fecha;

    /**
     * @var string
     */
    private $estado;


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
     * @return Cliente
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
     * Set fecha
     *
     * @param string $fecha
     *
     * @return Cliente
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return string
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Cliente
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

