<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cajas
 */
class Cajas
{
    /**
     * @var integer
     * @GeneratedValue(strategy="AUTO")
     */
    private $idcaja;

    /**
     * @var string
     */
    private $fecha;

    /**
     * @var \Entity\FormasPago
     */
    private $idforma;


    /**
     * Set idcaja
     *
     * @param integer $idcaja
     * @return Cajas
     */
    public function setIdcaja($idcaja)
    {
        $this->idcaja = $idcaja;
    
        return $this;
    }

    /**
     * Get idcaja
     *
     * @return integer 
     */
    public function getIdcaja()
    {
        return $this->idcaja;
    }

    /**
     * Set fecha
     *
     * @param string $fecha
     * @return Cajas
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
     * Set idforma
     *
     * @param \Entity\FormasPago $idforma
     * @return Cajas
     */
    public function setIdforma(\Entity\FormasPago $idforma = null)
    {
        $this->idforma = $idforma;
    
        return $this;
    }

    /**
     * Get idforma
     *
     * @return \Entity\FormasPago 
     */
    public function getIdforma()
    {
        return $this->idforma;
    }
}
