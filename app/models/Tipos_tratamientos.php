<?php
class Tipostratamientos extends Eloquent {
protected $table = 'tipostratamientos';
protected $fillable = array('id','tipo');
public function tratamientos()
    {
        return $this->belogsToMany('Tratamientos', 'precios',   'companias_id', 'tratamientos_id')->withPivot('precios');
    }
    public function pacientes(){
        return $this->belongsToMany('Pacientes', 'pacientes', 'companias', 'companias_id');
    }
}