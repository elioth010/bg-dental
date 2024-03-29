<?php
use Illuminate\Database\Eloquent\Relations\Pivot;

class Historial_clinico extends Eloquent {

    public $timestamps = true;
    protected $table = 'historial_clinico';
    protected $fillable = array('paciente_id', 'profesional_id', 'tratamiento_id', 'fecha_realizacion', 'cobrado_paciente', 'abonado_quiron', 'cobrado_profesional', 'precio', 'pendiente_de_cobro',
                                'ayudantia', 'id_hist_ayudantia', 'ayudantia_aplicada', 'unidades', 'presupuesto_tratamiento_id');


    public static $p_rules = array(
        'fecha_realizacion'=>'required',
//        'descuento'=>'required',
//        'grupo'=>'required|numeric|valor de grupo existente',
//        'tratamiento'=>'required|numeric|valor de tratamiento existente',
    );
    public function cobro(){
        return $this->hasOne('Cobros');
    }


}
