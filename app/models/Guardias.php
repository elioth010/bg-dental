<?php
class Guardias extends Eloquent {
    protected $table = 'guardias';
    protected $fillable = array('fecha_guardia','profesional_id');
}
