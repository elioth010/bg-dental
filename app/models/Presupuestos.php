<?php

class Presupuestos extends Eloquent {

protected $table = 'presupuestos';
protected $fillable = array('nombre','aceptado','numerohistoria');
public function tratamientos(){
        return $this->belongsToMany('Tratamientos', 'presupuestos_tratamientos', 'tratamiento_id', 'presupuesto_id');
    }
}