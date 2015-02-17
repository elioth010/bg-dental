<?php
use Illuminate\Database\Eloquent\Relations\Pivot;

class PresupuestoTratamiento extends Pivot {

    public $timestamps = false;
    protected $table = 'presupuestos_tratamientos';
    protected $fillable = array('presupuesto_id', 'tratamiento_id', 'unidades', 'descuento', 'tipodescuento', 'piezas', 'estado');

    public function tratamientos() {
        return $this->belongsTo('Tratamientos');
    }

    public function presupuestos() {
        return $this->belongsTo('Presupuestos');
    }
}
