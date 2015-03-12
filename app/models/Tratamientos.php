<?php

class Tratamientos extends Eloquent {

    protected $table = 'tratamientos';
    protected $fillable = array('codigo','nombre','precio_base','grupostratamientos_id', 'tipostratamientos_id', 'activo');

    public function precios() {
        return $this->belongsToMany('Precios', 'precios', 'tratamientos_id', 'companias_id')->withPivot('precios');
    }

    public function presupuestos() {
        return $this->belongsToMany('Presupuestos', 'presupuestos_tratamientos', 'tratamiento_id', 'presupuesto_id');
    }

    public function newPivot(Eloquent $parent, array $attributes, $table, $exists) {
        if ($parent instanceof Presupuestos) {
            return new PresupuestoTratamiento($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }

// public function grupos(){
// 	return $this->belongsTo('Grupos', 'grupostratamientos_tratamientos');
// 	//->withPivot('tratamientos_id','grupostratamientos_id');
// }
// public function precios(){
//         return $this->hasMany('Precios', 'precios', 'tratamientos_id', 'companias_id');
//     }
}
