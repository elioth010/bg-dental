<?php

class PopulateProfesional extends Eloquent{
protected $table = 'profesionales';
protected $connection = 'bg_dental';
protected $fillable = array('nombre', 'apellido1', 'apellido2', 'especialidades_id');
}
