<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profesional
 */
class Profesional
{
    /**
     * @var integer
     */
    private $idprofesional;

    /**
     * @var string
     */
    private $actividad;

    /**
     * @var string
     */
    private $nccc;

    /**
     * @var \Entity\Users
     */
    private $login;

    /**
     * @var \Entity\Delegaciones
     */
    private $iddelegacion;

    /**
     * @var \Entity\Personas
     */
    private $idpersonas;


    /**
     * Get idprofesional
     *
     * @return integer 
     */
    public function getIdprofesional()
    {
        return $this->idprofesional;
    }

    /**
     * Set actividad
     *
     * @param string $actividad
     * @return Profesional
     */
    public function setActividad($actividad)
    {
        $this->actividad = $actividad;
    
        return $this;
    }

    /**
     * Get actividad
     *
     * @return string 
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set nccc
     *
     * @param string $nccc
     * @return Profesional
     */
    public function setNccc($nccc)
    {
        $this->nccc = $nccc;
    
        return $this;
    }

    /**
     * Get nccc
     *
     * @return string 
     */
    public function getNccc()
    {
        return $this->nccc;
    }

    /**
     * Set login
     *
     * @param \Entity\Users $login
     * @return Profesional
     */
    public function setLogin(\Entity\Users $login = null)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return \Entity\Users 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set iddelegacion
     *
     * @param \Entity\Delegaciones $iddelegacion
     * @return Profesional
     */
    public function setIddelegacion(\Entity\Delegaciones $iddelegacion = null)
    {
        $this->iddelegacion = $iddelegacion;
    
        return $this;
    }

    /**
     * Get iddelegacion
     *
     * @return \Entity\Delegaciones 
     */
    public function getIddelegacion()
    {
        return $this->iddelegacion;
    }

    /**
     * Set idpersonas
     *
     * @param \Entity\Personas $idpersonas
     * @return Profesional
     */
    public function setIdpersonas(\Entity\Personas $idpersonas = null)
    {
        $this->idpersonas = $idpersonas;
    
        return $this;
    }

    /**
     * Get idpersonas
     *
     * @return \Entity\Personas 
     */
    public function getIdpersonas()
    {
        return $this->idpersonas;
    }
}
