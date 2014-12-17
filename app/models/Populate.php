<?php

class Populate extends Eloquent{
protected $table = 'pacientes';
protected $connection = 'quiron';
protected $fillable = array('numerohistoria','apellido1','apellido2','nombre','NIF','fechanacimiento','sexo','Direccion','addrnamestre','addrtel1','addrtel2','terrdesc','addrpostcode');
}