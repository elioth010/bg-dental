<?php
class Profesional extends Eloquent {
protected $table = 'profesionales';
protected $fillable = array('nombre','apellido1','apellido2','especialidades_id', 'activo');

public function especialidad(){
        return $this->hasOne('Especialidad');
}
public function user(){
        return $this->hasOne('User');
}

public function sedes() {
        return $this->belongsToMany('Sedes', 'sedes_profesionales', 'profesional_id', 'sede_id');
    }
}