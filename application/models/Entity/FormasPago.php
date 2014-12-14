<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormasPago
 */
class FormasPago
{
    /**
     * @var integer
     */
    private $idformapago;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get idformapago
     *
     * @return integer 
     */
    public function getIdformapago()
    {
        return $this->idformapago;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return FormasPago
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
