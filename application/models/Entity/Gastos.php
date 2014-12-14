<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gastos
 */
class Gastos
{
    /**
     * @var integer
     */
    private $idgastos;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \Entity\Cajas
     */
    private $idcaja;

    /**
     * @var \Entity\TiposGasto
     */
    private $idtipogasto;


    /**
     * Set idgastos
     *
     * @param integer $idgastos
     * @return Gastos
     */
    public function setIdgastos($idgastos)
    {
        $this->idgastos = $idgastos;
    
        return $this;
    }

    /**
     * Get idgastos
     *
     * @return integer 
     */
    public function getIdgastos()
    {
        return $this->idgastos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Gastos
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
     * @return Gastos
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
     * Set idtipogasto
     *
     * @param \Entity\TiposGasto $idtipogasto
     * @return Gastos
     */
    public function setIdtipogasto(\Entity\TiposGasto $idtipogasto = null)
    {
        $this->idtipogasto = $idtipogasto;
    
        return $this;
    }

    /**
     * Get idtipogasto
     *
     * @return \Entity\TiposGasto 
     */
    public function getIdtipogasto()
    {
        return $this->idtipogasto;
    }
}
