<?php
class Opciones extends Eloquent {
    public $timestamps = false;
    protected $table = 'opciones';
    protected $fillable = array('nombre','valor');
}
