<?php

class Turnos extends Eloquent {
    public $timestamps = false;

    protected $table = 'turnos';
    protected $fillable = array('fecha_turno',  'tipo_turno', 'profesional_id', 'sede_id', 'incidencia', 'incidencia_text');
    // tipo_turno = ('M1', 'M2', 'T1', 'T2')

    // Devuelve un array con el calendario de los profesionales de un mes concreto (formato y-m-d: 2015-03-01)
    public function scopeMonth($query, $month) {
        return $query->where('fecha_turno', $month);
    }


}
