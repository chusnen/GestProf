<?php

class Persona extends DataMapper {
	public $table = "Personas";
 //una persona tiene un profesional, cliente y proveedor
    var $has_one = array('Profesional');
    var $has_one =array('Cliente')
    var $has_one =array('Proveedor')

}