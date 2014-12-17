<?php
class Precios extends Eloquent {
protected $table = 'precios';
protected $fillable = array('tratamientos_id','companias_id','precio');
}