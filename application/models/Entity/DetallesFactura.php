<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetallesFactura
 */
class DetallesFactura
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $cantidad;

    /**
     * @var string
     */
    private $descuento;

    /**
     * @var \Entity\Facturas
     */
    private $idfactura;

    /**
     * @var \Entity\Iva
     */
    private $idiva;


    /**
     * Set id
     *
     * @param integer $id
     * @return DetallesFactura
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return DetallesFactura
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
     * Set cantidad
     *
     * @param string $cantidad
     * @return DetallesFactura
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     * @return DetallesFactura
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return string 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set idfactura
     *
     * @param \Entity\Facturas $idfactura
     * @return DetallesFactura
     */
    public function setIdfactura(\Entity\Facturas $idfactura = null)
    {
        $this->idfactura = $idfactura;
    
        return $this;
    }

    /**
     * Get idfactura
     *
     * @return \Entity\Facturas 
     */
    public function getIdfactura()
    {
        return $this->idfactura;
    }

    /**
     * Set idiva
     *
     * @param \Entity\Iva $idiva
     * @return DetallesFactura
     */
    public function setIdiva(\Entity\Iva $idiva = null)
    {
        $this->idiva = $idiva;
    
        return $this;
    }

    /**
     * Get idiva
     *
     * @return \Entity\Iva 
     */
    public function getIdiva()
    {
        return $this->idiva;
    }
}
