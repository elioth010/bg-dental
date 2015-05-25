<?php
class Companias extends Eloquent {
protected $table = 'companias';
protected $fillable = array('nombre','codigo','comentarios','activo');
public function tratamientos()
    {
        return $this->belogsToMany('Tratamientos', 'precios',   'companias_id', 'tratamientos_id')->withPivot('precios');
    }
    public function pacientes(){
        return $this->belongsToMany('Pacientes', 'pacientes', 'companias', 'companias_id');
    }

    public static $p_rules = array(
        'nombre' => 'required|unique:companias',
        'codigo' => 'required|unique:companias',
    );
}
