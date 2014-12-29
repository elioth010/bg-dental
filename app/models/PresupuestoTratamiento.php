<?php
use Illuminate\Database\Eloquent\Relations\Pivot;

class PresupuestoTratamiento extends Pivot {

    protected $table = 'presupuestos_tratamientos';
    protected $fillable = array('presupuesto_id','tratamiento_id','tipostratamientos_id','unidades','desc_euros','desc_porcien',
                                'pieza1', 'pieza2', 'pieza3', 'estado');

    public function tratamientos() {
        return $this->belongsTo('Tratamientos');
    }

    public function presupuestos() {
        return $this->belongsTo('Presupuestos');
    }
}
