<?php
class Usergroups extends Eloquent {
    protected $table = 'usergroups';
    protected $fillable = array('nombre');

    const ADMIN = 1;
    const USER = 2;
    const VIEWER = 3;
    const PROFESIONAL = 4;
    const ASESOR = 5;
    const HIGIENISTA = 6;
    const RECEPCION = 7;
}
?>
