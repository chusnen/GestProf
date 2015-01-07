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
     * @var float
     */
    private $preciounitario;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var float
     */
    private $descuento;

    /**
     * @var float
     */
    private $baseimponible;

    /**
     * @var float
     */
    private $cantidadIva;

    /**
     * @var float
     */
    private $total;

    /**
     * @var \Entity\Facturas
     */
    private $idfactura;

    /**
     * @var \Entity\Iva
     */
    private $idiva;


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
     * Set preciounitario
     *
     * @param float $preciounitario
     * @return DetallesFactura
     */
    public function setPreciounitario($preciounitario)
    {
        $this->preciounitario = $preciounitario;
    
        return $this;
    }

    /**
     * Get preciounitario
     *
     * @return float 
     */
    public function getPreciounitario()
    {
        return $this->preciounitario;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
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
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set descuento
     *
     * @param float $descuento
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
     * @return float 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set baseimponible
     *
     * @param float $baseimponible
     * @return DetallesFactura
     */
    public function setBaseimponible($baseimponible)
    {
        $this->baseimponible = $baseimponible;
    
        return $this;
    }

    /**
     * Get baseimponible
     *
     * @return float 
     */
    public function getBaseimponible()
    {
        return $this->baseimponible;
    }

    /**
     * Set cantidadIva
     *
     * @param float $cantidadIva
     * @return DetallesFactura
     */
    public function setCantidadIva($cantidadIva)
    {
        $this->cantidadIva = $cantidadIva;
    
        return $this;
    }

    /**
     * Get cantidadIva
     *
     * @return float 
     */
    public function getCantidadIva()
    {
        return $this->cantidadIva;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return DetallesFactura
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
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
