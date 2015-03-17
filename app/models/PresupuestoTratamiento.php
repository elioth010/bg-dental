<?php
use Illuminate\Database\Eloquent\Relations\Pivot;

class PresupuestoTratamiento extends Pivot {

    public $timestamps = false;
    protected $table = 'presupuestos_tratamientos';
    protected $fillable = array('presupuesto_id', 'tratamiento_id', 'precio_final', 'unidades', 'descuento', 'tipodescuento', 'piezas', 'estado', 'compania_id');

    public function tratamientos() {
        return $this->belongsTo('Tratamientos');
    }

    public function presupuestos() {
        return $this->belongsTo('Presupuestos');
    }

    // TODO: Validator:
    // Comprobar que ha especificado las piezas/puente si el tratamiento lo requiere. piezas != ""

    public static $p_rules = array(
//        'nombre'=>'required|min:2',
        'descuento'=>'required|numeric',
//        'grupo'=>'required|numeric|valor de grupo existente',
//        'tratamiento'=>'required|numeric|valor de tratamiento existente',
    );


}
