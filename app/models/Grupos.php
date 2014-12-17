<?php
class Grupos extends Eloquent {
protected $table = 'grupostratamientos';
protected $fillable = array('id','nombre','codigo');
public function tratamientos(){
	return $this->hasMany('Tratamientos', 'grupostratamientos_id');
	//->withPivot('grupostratamientos_id','tratamientos_id');
	}

}