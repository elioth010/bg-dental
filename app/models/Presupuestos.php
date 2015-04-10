<?php

class Presupuestos extends Eloquent {

    protected $table = 'presupuestos';
    protected $fillable = array('nombre','aceptado','numerohistoria', 'user_id', 'profesional_id', 'descuento', 'tipodescuento');

    public function tratamientos() {
        return $this->belongsToMany('Tratamientos', 'presupuestos_tratamientos', 'presupuesto_id', 'tratamiento_id');
    }

    public function tratamientos2() {
        return $this->belongsToMany('Tratamientos', 'presupuestos_tratamientos', 'presupuesto_id', 'id');
    }

    public function paciente() {
        return $this->belongsTo('Pacientes', 'numerohistoria', 'numerohistoria');
    }

    public function newPivot(Eloquent $parent, array $attributes, $table, $exists) {
        if ($parent instanceof Tratamientos) {
            return new PresupuestoTratamiento($parent, $attributes, $table, $exists);
        }
        return parent::newPivot($parent, $attributes, $table, $exists);
    }

    public static $p_rules = array(
//        'nombre'=>'required|min:2',
        'descuento'=>'required|numeric',
//        'grupo'=>'required|numeric|valor de grupo existente',
//        'tratamiento'=>'required|numeric|valor de tratamiento existente',
//        'piezas'=>'...',
    );

}
