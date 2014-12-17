<?php
class Companias extends Eloquent {
protected $table = 'companias';
protected $fillable = array('nombre','codigo','comentarios');
public function tratamientos()
    {
        return $this->belogsToMany('Tratamientos', 'precios', 'companias_id', 'tratamientos_id')->withPivot('precio');
    }
    public function pacientes(){
        return $this->belongsToMany('Pacientes', 'pacientes', 'companias', 'companias_id');
    }
}