<?php

class Pacientes extends Eloquent {

protected $table = 'pacientes';
protected $fillable = array('numerohistoria','apellido1','apellido2','nombre','NIF','fechanacimiento','sexo','Direccion','addrnamestre','addrtel1','addrtel2','terrdesc','addrpostcode','compania');
public function companias(){
        return $this->hasOne('Companias', 'companias', 'companias_id', 'companias');
    }
}