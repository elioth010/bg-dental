<?php

class TratamientosController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $grupos = Grupos::lists('nombre', 'id');
        return View::make('tratamientos.elegir_grupo')->with(array('grupos' => $grupos));
    }

    public function index_tpg() {
        $grupo = Input::get('grupos');

        $companias = Companias::where('activo', 1)->lists('nombre', 'id');

        $tratamientos = Tratamientos::where('tratamientos.activo', '=', '1')->where('tratamientos.grupostratamientos_id', '=', $grupo)
                ->leftJoin('precios', 'precios.tratamientos_id', '=', 'tratamientos.id')
                ->select('tratamientos.id', 'tratamientos.codigo', 'tratamientos.nombre','tratamientos.quirofano', 'tratamientos.historiable', DB::raw('GROUP_CONCAT(IFNULL(precios.precio, "NULL") ORDER BY precios.companias_id) as precios'))
                ->groupBy('tratamientos.id')
                ->get();


        return View::make('tratamientos.index')->with(array('companias' => $companias, 'tratamientos' => $tratamientos));
    }

//    public function index()
//    {
//        $companias = Companias::lists('nombre', 'id');
//
//        $tratamientos = Tratamientos::where('tratamientos.activo', '=', '1')
//                            ->leftJoin('precios', 'precios.tratamientos_id','=','tratamientos.id')
//                            ->select('tratamientos.id','tratamientos.codigo', 'tratamientos.nombre',DB::raw('GROUP_CONCAT(IFNULL(precios.precio, "NULL") ORDER BY precios.companias_id) as precios'))
//                            ->groupBy('tratamientos.id')
//                            ->orderBy('precios.companias_id')
//                            ->get();
//
//        return View::make('tratamientos.index')->with(array('companias' => $companias, 'tratamientos' => $tratamientos));
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $grupos = Grupos::lists('nombre', 'id');
        $tipos_tratamientos = TiposTratamientos::lists('tipo', 'id');
        $companias = Companias::get();
        $imagenes = Imagenes::lists('denominacion', 'id');

        return View::make('tratamientos.crear')->with(array('grupos' => $grupos, 'tipostratamientos' => $tipos_tratamientos, 'companias' => $companias, 'imagenes' => $imagenes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {

        $tratamiento = new Tratamientos;
        $tratamiento->nombre = Input::get('nombre');
        $tratamiento->codigo = Input::get('codigo');
        $tratamiento->grupostratamientos_id = Input::get('grupostratamientos_id');
        $tratamiento->tipostratamientos_id = Input::get('tipotratamiento');
        $tratamiento->activo = Input::get('activo', 1);
        $tratamiento->imagen = Input::get('imagen_id');
        $tratamiento->quirofano = Input::get('quirofano', 0);
        $tratamiento->historiable = Input::get('historiable', 0);
        $tratamiento->save();

        $companias = Companias::all();
        foreach ($companias as $compania) {
            if (Input::has('cid-' . $compania->id)) {
                $input_compania = Input::get('cid-' . $compania->id);
                $input_precio = Input::get('precio-' . $compania->id);

                if ($input_precio == '')
                    $input_precio = NULL;

                $input_precio = str_replace('.', '', $input_precio);
                $input_precio = str_replace(',', '.', $input_precio);
                $pt = array('precio' => $input_precio);
                $tratamiento->precios()->attach($input_compania, $pt);
            }
        }

        return Redirect::action('TratamientosController@index')->with('message', '¡Tratamiento guardado con éxito!');
        //return Redirect::action('TratamientosController@edit', $tratamiento->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show() {
        return View::make('tratamientos.buscar');
    }

    public function busqueda() {
        $q_nombre = Input::get('nombre', '');
        if ($q_nombre != '') {
            $nombre = "%" . $q_nombre . "%";
        }

        $q_codigo = Input::get('codigo', '');
        if ($q_codigo != '') {
            $codigo = "%" . $q_codigo . "%";
        }

        if (isset($nombre) || isset($codigo)) {

            $companias = Companias::lists('nombre', 'id');

            if (isset($nombre) && isset($codigo)) {
                $tratamientos = Tratamientos::where('nombre', 'LIKE', $nombre)->orWhere('codigo', 'LIKE', $codigo)
                        ->leftJoin('precios', 'precios.tratamientos_id', '=', 'tratamientos.id')
                        ->select('tratamientos.id', 'tratamientos.codigo', 'tratamientos.nombre', DB::raw('GROUP_CONCAT(IFNULL(precios.precio, "NULL") ORDER BY precios.companias_id) as precios'))
                        ->groupBy('tratamientos.id')
                        ->get();
            } elseif (isset($nombre)) {
                $tratamientos = Tratamientos::where('nombre', 'LIKE', $nombre)
                        ->leftJoin('precios', 'precios.tratamientos_id', '=', 'tratamientos.id')
                        ->select('tratamientos.id', 'tratamientos.codigo', 'tratamientos.nombre', DB::raw('GROUP_CONCAT(IFNULL(precios.precio, "NULL") ORDER BY precios.companias_id) as precios'))
                        ->groupBy('tratamientos.id')
                        ->get();
            } else {
                $tratamientos = Tratamientos::where('codigo', 'LIKE', $codigo)
                        ->leftJoin('precios', 'precios.tratamientos_id', '=', 'tratamientos.id')
                        ->select('tratamientos.id', 'tratamientos.codigo', 'tratamientos.nombre', DB::raw('GROUP_CONCAT(IFNULL(precios.precio, "NULL") ORDER BY precios.companias_id) as precios'))
                        ->groupBy('tratamientos.id')
                        ->get();
            }

        } else {
            return Redirect::action('TratamientosController@busqueda');
        }

        return View::make('tratamientos.busqueda')->with(array('tratamientos' => $tratamientos, 'companias' => $companias,
                                                               'q_nombre' => $q_nombre, 'q_codigo' => $q_codigo));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $tratamiento = Tratamientos::where('id', $id)->firstOrFail();
        $grupos = Grupos::lists('nombre', 'id');
        $companias = Companias::lists('nombre', 'id');
        $tipos = TiposTratamientos::get();
        $imagenes = Imagenes::lists('denominacion', 'nombre');

        $imagenes[0] = '-- Ninguna --';
        asort($imagenes);
        $imgselected = $tratamiento->imagen == null ? 0 : $tratamiento->imagen;

        $precios = Precios::leftJoin('tratamientos', 'tratamientos.id', '=', 'tratamientos_id')
                ->leftJoin('companias', 'companias.id', '=', 'companias_id')
                //->leftJoin('imagenes', 'imagenes.id', '=', 'imagen')
                ->select('companias.nombre as nombre_comp', 'companias.id as cid', 'precio', 'grupostratamientos_id', 'tipostratamientos_id')
                ->where('tratamientos.id', $id)
                ->get();

        if ($precios->isEmpty()) {
            $precios = array();
            foreach ($companias as $cid => $nombre) {
                $precios[] = array('cid' => $cid, 'precio' => '', 'disabled' => TRUE);
            }
        } else {
            foreach ($precios as $p) {
                $p->disabled = is_null($p->precio);
            }
        }

        return View::make('tratamientos.edit')->with(array('tratamiento' => $tratamiento, 'precios' => $precios,
                    'grupos' => $grupos, 'tipos' => $tipos, 'imagenes' => $imagenes, 'imgselected' => $imgselected,
                    'companias' => $companias));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $tratamiento = Tratamientos::find($id);
        $tratamiento->nombre = Input::get('nombre');
        $tratamiento->codigo = Input::get('codigo');
        $tratamiento->grupostratamientos_id = Input::get('grupostratamientos_id');
        $tratamiento->tipostratamientos_id = Input::get('tipotratamiento');
        $tratamiento->activo = Input::get('activo', 1);
        $tratamiento->quirofano = Input::get('quirofano', 0);
        $tratamiento->historiable = Input::get('historiable', 0);

        $imagen = Input::get('imagen_id');
        if ($imagen == "0") {
            $imagen = null;
        }

        $tratamiento->imagen = $imagen;
        $tratamiento->update();

        $tratamiento->precios()->detach();

        $companias = Companias::all();
        foreach ($companias as $compania) {
            if (Input::has('cid-' . $compania->id)) {
                $input_compania = Input::get('cid-' . $compania->id);
                $input_precio = Input::get('precio-' . $compania->id);

                $input_activado = Input::get('activado-' . $compania->id);
                if ($input_precio == '' || !$input_activado)
                    $input_precio = NULL;

                $input_precio = str_replace('.', '', $input_precio);
                $input_precio = str_replace(',', '.', $input_precio);

                $pt = array('precio' => $input_precio);
                $tratamiento->precios()->attach($input_compania, $pt);
            }
        }

        //return Redirect::action('TratamientosController@index');
        return Redirect::action('TratamientosController@edit', $tratamiento->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $tratamiento = Tratamientos::find($id);
        $tratamiento->activo = 0;
        $tratamiento->update();
        return Redirect::action('TratamientosController@index');
    }

}
