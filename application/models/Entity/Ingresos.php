<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ingresos
 */
class Ingresos
{
    /**
     * @var integer
     * @GeneratedValue(strategy="AUTO")
     */
    private $idingresos;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \Entity\Cajas
     */
    private $idcaja;

    /**
     * @var \Entity\TiposIngreso
     */
    private $idtipoingreso;


    /**
     * Set idingresos
     *
     * @param integer $idingresos
     * @return Ingresos
     */
    public function setIdingresos($idingresos)
    {
        $this->idingresos = $idingresos;
    
        return $this;
    }

    /**
     * Get idingresos
     *
     * @return integer 
     */
    public function getIdingresos()
    {
        return $this->idingresos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Ingresos
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

    /**
     * Set idcaja
     *
     * @param \Entity\Cajas $idcaja
     * @return Ingresos
     */
    public function setIdcaja(\Entity\Cajas $idcaja = null)
    {
        $this->idcaja = $idcaja;
    
        return $this;
    }

    /**
     * Get idcaja
     *
     * @return \Entity\Cajas 
     */
    public function getIdcaja()
    {
        return $this->idcaja;
    }

    /**
     * Set idtipoingreso
     *
     * @param \Entity\TiposIngreso $idtipoingreso
     * @return Ingresos
     */
    public function setIdtipoingreso(\Entity\TiposIngreso $idtipoingreso = null)
    {
        $this->idtipoingreso = $idtipoingreso;
    
        return $this;
    }

    /**
     * Get idtipoingreso
     *
     * @return \Entity\TiposIngreso 
     */
    public function getIdtipoingreso()
    {
        return $this->idtipoingreso;
    }
}
