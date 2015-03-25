<?php
class Profesional extends Eloquent {
protected $table = 'profesionales';
protected $fillable = array('nombre','apellido1','apellido2','especialidades_id', 'sede_id');

public function especialidad(){
        return $this->hasOne('Especialidad');
}
public function sedes(){
        return $this->hasOne('Sedes');
}
}