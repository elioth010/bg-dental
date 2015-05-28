<?php
class Espera extends Eloquent {
    protected $table = 'espera';
    protected $fillable = array('paciente_id','admitido','profesional_id');

    public static $p_rules = array(
        'paciente_id'=>'required|unique:pacientes',
        'admitido'=>'required|numeric',
        'profesional_id'=>'required|unique:profesionales',
    );
}
