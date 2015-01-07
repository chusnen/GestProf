<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Facturas extends \Entity\Facturas implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setNumero($numero)
    {
        $this->__load();
        return parent::setNumero($numero);
    }

    public function getNumero()
    {
        $this->__load();
        return parent::getNumero();
    }

    public function setFecha($fecha)
    {
        $this->__load();
        return parent::setFecha($fecha);
    }

    public function getFecha()
    {
        $this->__load();
        return parent::getFecha();
    }

    public function setDescripcion($descripcion)
    {
        $this->__load();
        return parent::setDescripcion($descripcion);
    }

    public function getDescripcion()
    {
        $this->__load();
        return parent::getDescripcion();
    }

    public function setBaseimponible($baseimponible)
    {
        $this->__load();
        return parent::setBaseimponible($baseimponible);
    }

    public function getBaseimponible()
    {
        $this->__load();
        return parent::getBaseimponible();
    }

    public function setIva($iva)
    {
        $this->__load();
        return parent::setIva($iva);
    }

    public function getIva()
    {
        $this->__load();
        return parent::getIva();
    }

    public function setIrpf($irpf)
    {
        $this->__load();
        return parent::setIrpf($irpf);
    }

    public function getIrpf()
    {
        $this->__load();
        return parent::getIrpf();
    }

    public function setTotal($total)
    {
        $this->__load();
        return parent::setTotal($total);
    }

    public function getTotal()
    {
        $this->__load();
        return parent::getTotal();
    }

    public function setRutapdf($rutapdf)
    {
        $this->__load();
        return parent::setRutapdf($rutapdf);
    }

    public function getRutapdf()
    {
        $this->__load();
        return parent::getRutapdf();
    }

    public function setTipo($tipo)
    {
        $this->__load();
        return parent::setTipo($tipo);
    }

    public function getTipo()
    {
        $this->__load();
        return parent::getTipo();
    }

    public function setIdprofesional(\Entity\Profesional $idprofesional = NULL)
    {
        $this->__load();
        return parent::setIdprofesional($idprofesional);
    }

    public function getIdprofesional()
    {
        $this->__load();
        return parent::getIdprofesional();
    }

    public function setIdcaja(\Entity\Cajas $idcaja = NULL)
    {
        $this->__load();
        return parent::setIdcaja($idcaja);
    }

    public function getIdcaja()
    {
        $this->__load();
        return parent::getIdcaja();
    }

    public function setIdcliente(\Entity\Clientes $idcliente = NULL)
    {
        $this->__load();
        return parent::setIdcliente($idcliente);
    }

    public function getIdcliente()
    {
        $this->__load();
        return parent::getIdcliente();
    }

    public function setIdproveedores(\Entity\Proveedores $idproveedores = NULL)
    {
        $this->__load();
        return parent::setIdproveedores($idproveedores);
    }

    public function getIdproveedores()
    {
        $this->__load();
        return parent::getIdproveedores();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'numero', 'fecha', 'descripcion', 'baseimponible', 'iva', 'irpf', 'total', 'rutapdf', 'tipo', 'idprofesional', 'idcaja', 'idcliente', 'idproveedores');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}