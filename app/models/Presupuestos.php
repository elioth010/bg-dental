<?php

class Presupuestos extends Eloquent {

    protected $table = 'presupuestos';
    protected $fillable = array('nombre','aceptado','numerohistoria');

    public function tratamientos() {
        return $this->belongsToMany('Tratamientos', 'presupuestos_tratamientos', 'presupuesto_id', 'tratamiento_id');
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
}
