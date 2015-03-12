<?php

class Precios extends Eloquent {

    protected $table = 'precios';
    protected $fillable = array('tratamientos_id','companias_id','precio');

    // Devuelve un array con los precios para un paciente según sus compañías
    public function scopePaciente($query, $numerohistoria)
    {
        $paciente = Pacientes::where('numerohistoria', $numerohistoria)->first();

        $companias = array();
        $companias[] = $paciente->compania;
        if (is_numeric($paciente->compania2)) {
            $companias[] = $paciente->compania2;
        }

        $preciosObj = $query->whereIn('companias_id', $companias)->get(array('tratamientos_id', 'precio', 'companias_id'));
        $precios = array();
        foreach ($preciosObj as $p) {
            $precios[$p->tratamientos_id][$p->companias_id] = $p->precio;
        }
        return $precios;
    }
}
