<?php

class Tratamientos extends Eloquent {
protected $table = 'tratamientos';
protected $fillable = array('codigo','nombre','precio','grupostratamientos_id');
public function companias()
    {
        return $this->belongsToMany('Companias', 'precios', 'tratamientos_id','companias_id')->withPivot('precio');
    }

public function presupuestos(){
        return $this->hasMany('Presupuestos', 'presupuestos_tratamientos', 'tratamiento_id', 'presupuesto_id');
    }
    

// public function grupos(){
// 	return $this->belongsTo('Grupos', 'grupostratamientos_tratamientos');
// 	//->withPivot('tratamientos_id','grupostratamientos_id');
// }
// public function precios(){
//         return $this->hasMany('Precios', 'precios', 'tratamientos_id', 'companias_id');
//     }
}


