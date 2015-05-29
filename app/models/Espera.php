<?php
class Espera extends Eloquent {
    const CREATED_AT = 'begin_date';

    protected $table = 'espera';
    protected $fillable = array('paciente_id','admitido','profesional_id', 'begin_date', 'end_date');

    public static $p_rules = array(
        'paciente_id'=>'required|unique:pacientes',
        'admitido'=>'required|numeric',
        'profesional_id'=>'required|unique:profesionales',
    );
}
