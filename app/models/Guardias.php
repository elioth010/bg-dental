<?php
class Guardias extends Eloquent {
    
     public static $rules = array(
        'fecha_inicio'=> 'required',
         'fecha_fin'=>'required'
        );
     
    public $timestamps = false;
    
    protected $table = 'guardias';
    protected $fillable = array('fecha_guardia','profesional_id', 'sede_id');
}
