<?php
class Cobros extends Eloquent {
    protected $table = 'cobros';
    protected $fillable = array('paciente_id','cobro', 'tipos_de_cobro_id');
}
