<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TiposGasto
 */
class TiposGasto
{
    /**
     * @var integer
     * @GeneratedValue(strategy="AUTO")
     */
    private $idtipogasto;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get idtipogasto
     *
     * @return integer 
     */
    public function getIdtipogasto()
    {
        return $this->idtipogasto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return TiposGasto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
