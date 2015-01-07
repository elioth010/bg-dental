<?php
class Profesional extends Eloquent {
protected $table = 'profesionales';
protected $fillable = array('nombre','apellido1','apellido2','especialidad');
}