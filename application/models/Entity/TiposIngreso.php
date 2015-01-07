<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TiposIngreso
 */
class TiposIngreso
{
    /**
     * @var integer
     */
    private $idtipoingreso;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get idtipoingreso
     *
     * @return integer 
     */
    public function getIdtipoingreso()
    {
        return $this->idtipoingreso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return TiposIngreso
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
