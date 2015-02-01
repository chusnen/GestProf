<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provincia
 */
class Provincia
{
    /**
     * @var integer
     */
    private $idprovincia;

    /**
     * @var string
     */
    private $provincia;


    /**
     * Get idprovincia
     *
     * @return integer 
     */
    public function getIdprovincia()
    {
        return $this->idprovincia;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return Provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    
        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
