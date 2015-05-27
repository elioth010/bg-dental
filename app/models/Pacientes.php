<?php

class Pacientes extends Eloquent {

protected $table = 'pacientes';
protected $fillable = array('numerohistoria','apellido1','apellido2','nombre','NIF','fechanacimiento','sexo','Direccion','addrnamestre','addrtel1','addrtel2','terrdesc','addrpostcode','compania','compania2');

    // ?
    public function companias(){
        return $this->hasOne('Companias', 'companias', 'companias_id', 'companias');
    }

    public static $p_rules = array(
        'numerohistoria'=>'required|unique:pacientes',
        'nombre'=>'required|min:2',
        'apellido1'=>'required|min:2',
//        'apellido2'=>'required|alpha|min:2',
//        'NIF'=>'required|alpha_num|min:5',
//        'addrnamestr'=>'required|alpha|min:2',
//        'direccion'=>'required|alpha|min:2',
//        'terrdesc'=>'required|alpha|min:2',
//        'addrpostcode'=>'required|numeric|min:2',
//        'addrtel1'=>'required|alpha|min:2',
//        'addrtel2'=>'required|alpha|min:2',
//        'sexo'=>'required',
//        'compania'=>'required|alpha|min:2',
//        'mail'=>'required|email',
    );
}
