<?php

class Turnos extends Eloquent {
    protected $table = 'turnos';
    protected $fillable = array('fecha_turno', 'profesional_id');
    // TODO: campo para distinguir mañana/tarde
}
