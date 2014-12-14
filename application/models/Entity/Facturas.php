<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facturas
 */
class Facturas
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $numero;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var float
     */
    private $baseimponible;

    /**
     * @var float
     */
    private $iva;

    /**
     * @var integer
     */
    private $irpf;

    /**
     * @var float
     */
    private $total;

    /**
     * @var string
     */
    private $rutapdf;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \Entity\Proveedores
     */
    private $idproveedores;

    /**
     * @var \Entity\Clientes
     */
    private $idcliente;

    /**
     * @var \Entity\Profesional
     */
    private $idprofesional;

    /**
     * @var \Entity\Cajas
     */
    private $idcaja;


    /**
     * Set id
     *
     * @param integer $id
     * @return Facturas
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
     * Set numero
     *
     * @param string $numero
     * @return Facturas
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Facturas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set baseimponible
     *
     * @param float $baseimponible
     * @return Facturas
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
     * Set iva
     *
     * @param float $iva
     * @return Facturas
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    
        return $this;
    }

    /**
     * Get iva
     *
     * @return float 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set irpf
     *
     * @param integer $irpf
     * @return Facturas
     */
    public function setIrpf($irpf)
    {
        $this->irpf = $irpf;
    
        return $this;
    }

    /**
     * Get irpf
     *
     * @return integer 
     */
    public function getIrpf()
    {
        return $this->irpf;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Facturas
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
     * Set rutapdf
     *
     * @param string $rutapdf
     * @return Facturas
     */
    public function setRutapdf($rutapdf)
    {
        $this->rutapdf = $rutapdf;
    
        return $this;
    }

    /**
     * Get rutapdf
     *
     * @return string 
     */
    public function getRutapdf()
    {
        return $this->rutapdf;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Facturas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set idproveedores
     *
     * @param \Entity\Proveedores $idproveedores
     * @return Facturas
     */
    public function setIdproveedores(\Entity\Proveedores $idproveedores = null)
    {
        $this->idproveedores = $idproveedores;
    
        return $this;
    }

    /**
     * Get idproveedores
     *
     * @return \Entity\Proveedores 
     */
    public function getIdproveedores()
    {
        return $this->idproveedores;
    }

    /**
     * Set idcliente
     *
     * @param \Entity\Clientes $idcliente
     * @return Facturas
     */
    public function setIdcliente(\Entity\Clientes $idcliente = null)
    {
        $this->idcliente = $idcliente;
    
        return $this;
    }

    /**
     * Get idcliente
     *
     * @return \Entity\Clientes 
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Set idprofesional
     *
     * @param \Entity\Profesional $idprofesional
     * @return Facturas
     */
    public function setIdprofesional(\Entity\Profesional $idprofesional = null)
    {
        $this->idprofesional = $idprofesional;
    
        return $this;
    }

    /**
     * Get idprofesional
     *
     * @return \Entity\Profesional 
     */
    public function getIdprofesional()
    {
        return $this->idprofesional;
    }

    /**
     * Set idcaja
     *
     * @param \Entity\Cajas $idcaja
     * @return Facturas
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
}
