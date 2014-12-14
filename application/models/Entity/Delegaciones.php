<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Delegaciones
 */
class Delegaciones
{
    /**
     * @var integer
     */
    private $iddelegacion;

    /**
     * @var string
     */
    private $poblacion;


    /**
     * Get iddelegacion
     *
     * @return integer 
     */
    public function getIddelegacion()
    {
        return $this->iddelegacion;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     * @return Delegaciones
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    
        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string 
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }
}
