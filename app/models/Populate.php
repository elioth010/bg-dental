<?php

class Populate extends Eloquent{
protected $table = 'pacientes';
protected $connection = 'bg_dental';
protected $fillable = array('numerohistoria','apellido1','apellido2','nombre','NIF','fechanacimiento','sexo','Direccion','addrnamestre','addrtel1','addrtel2','terrdesc','addrpostcode');
}
