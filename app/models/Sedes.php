<?php
class Sedes extends Eloquent {
protected $table = 'sedes';
protected $fillable = array('nombre');

public function users() {
        return $this->belongsToMany('Users', 'sedes_users', 'sede_id', 'user_id');
    }
public function profesionales() {
        return $this->belongsToMany('Profesionales', 'sedes_profesionales', 'sede_id', 'profesional_id');
    }
}