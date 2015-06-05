<?php
class Guardias extends Eloquent {
    public $timestamps = false;
    
    protected $table = 'guardias';
    protected $fillable = array('fecha_guardia','profesional_id', 'sede_id');
}
