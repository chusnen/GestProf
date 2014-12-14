<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Iva
 */
class Iva
{
    /**
     * @var integer
     */
    private $idiva;

    /**
     * @var integer
     */
    private $tipo;

    /**
     * @var string
     */
    private $descripcion;


    /**
     * Get idiva
     *
     * @return integer 
     */
    public function getIdiva()
    {
        return $this->idiva;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Iva
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Iva
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
