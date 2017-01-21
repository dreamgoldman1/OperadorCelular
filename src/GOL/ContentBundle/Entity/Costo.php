<?php

namespace GOL\ContentBundle\Entity;

/**
 * Costo
 */
class Costo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $valorSegundo;

    /**
     * @var string
     */
    private $fecha;


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
     * Set valorSegundo
     *
     * @param string $valorSegundo
     *
     * @return Costo
     */
    public function setValorSegundo($valorSegundo)
    {
        $this->valorSegundo = $valorSegundo;

        return $this;
    }

    /**
     * Get valorSegundo
     *
     * @return string
     */
    public function getValorSegundo()
    {
        return $this->valorSegundo;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     *
     * @return Costo
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
}

