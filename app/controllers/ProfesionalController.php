<?php

class ProfesionalController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $profesionales = Profesional::leftJoin('especialidades', 'especialidades.id', '=', 'profesionales.especialidades_id')->get();
//                $especialidades = Especialidad::lists('especialidad','id');
//                return View::make('profesionales.index', array('profesionales' => $profesionales))->with('especialidades', $especialidades);
        return Redirect::action('ProfesionalController@create');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $profesionales = Profesional::leftJoin('especialidades', 'especialidades.id', '=', 'profesionales.especialidades_id')
                        ->leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id','=','profesionales.id')
                        ->leftJoin('sedes', 'sedes.id', '=', 'sedes_profesionales.sede_id')->where('activo', 1)
                                ->groupBy('profesionales.id')->orderBy('profesionales.apellido1')
                        ->select('sedes.nombre','profesionales.id as p_id', 'profesionales.*', 'especialidades.*', DB::raw('GROUP_CONCAT(sedes.nombre) as sedes_p'))->get();
//        var_dump($profesionales);
//                return;
                $sedes = Sedes::get();
                $especialidades = Especialidad::lists('especialidad','id');
                $usuarios = User::get()->lists('fullname', 'id');
                return View::make('profesionales.index', array('profesionales' => $profesionales, 'especialidades'=> $especialidades, 'sedes' => $sedes, 'usuarios' => $usuarios));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $profesional = new Profesional;
        $profesional->nombre = Input::get('nombre');
        $profesional->apellido1 = Input::get('apellido1');
        $profesional->apellido2 = Input::get('apellido2');
        $profesional->especialidades_id = Input::get('especialidades_id');
        $profesional-> activo = 1;
        $profesional->user_id = Input::get('user_id');
        $profesional->save();
        $sedes = Sedes::count();
        $i = 1;

        // TODO: no hacer bucle sino loop de sedes
        while($i<=$sedes) {
            if(Input::has('sede-'.$i)) {
                $sede_profesional = Input::get('sede-'.$i);
                $profesional->sedes()->attach($sede_profesional);
            }
            $i++;
        }

        echo "Profesional guardado";
        return Redirect::action('ProfesionalController@index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

                $profesional = Profesional::leftJoin('especialidades', 'especialidades.id', '=', 'profesionales.especialidades_id')
                        ->leftJoin('sedes_profesionales', 'sedes_profesionales.profesional_id','=','profesionales.id')
                        ->leftJoin('sedes', 'sedes.id', '=', 'sedes_profesionales.sede_id')
                                ->groupBy('profesionales.id')
                        ->select('sedes.nombre','profesionales.id as p_id','profesionales.*','especialidades.*', DB::raw('GROUP_CONCAT(sedes.nombre) as sedes_p'), DB::raw('GROUP_CONCAT(sedes.id) as sedes_pid'))->find($id);
                $sedes_pid = explode(',',$profesional->sedes_pid);
//                if(!is_array($sedes_pid)){
//                    $sedes_pid = array($sedes_pid);
//                }
                //var_dump($sedes_pid);
                $especialidades = Especialidad::lists('especialidad','id');
                $sedes = Sedes::get();
                $profesionales_cuser = Profesional::where('user_id', '!=', 0)->get(array('user_id'))->toArray();
                $usuarios = User::whereNotIn('id', $profesionales_cuser)->get()->lists('fullname', 'id');
                return View::make('profesionales.edit')->with('profesional',$profesional)->with('sedes', $sedes)->with('especialidades', $especialidades)->with(array('sedes_pid'=>$sedes_pid, 'usuarios' => $usuarios));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $user_id = Input::get('user_id');
        $comprobar_unique = Profesional::where('user_id', $user_id)->get();
        if (count($comprobar_unique) > 0) {

            return Redirect::action('ProfesionalController@edit', $id)->with('message', 'Usuario ya asignado a otro profesional' );
        } else {
            $profesional = Profesional::find($id);
            //var_dump($profesional);
            $profesional->nombre = Input::get('nombre');
            $profesional->apellido1 = Input::get('apellido1');
            $profesional->apellido2 = Input::get('apellido2');
            $profesional->especialidades_id = Input::get('especialidades_id');

            $profesional->user_id = $user_id;
            $profesional->update();
//                $profesional->update(Input::all());
            $profesional->sedes()->detach();
            $num_sedes = Sedes::count();
            $i = 1;
            while ($i <= $num_sedes) {

                if (Input::has('sede-' . $i)) {
                    $sede_id = Input::get('sede-' . $i);
                    $profesional->sedes()->attach($sede_id);
                }
                $i++;
            }
            //return;
            return Redirect::action('ProfesionalController@index')->with('message', 'Profesional modificado con éxito.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $profesional = Profesional::find($id);
                //var_dump($profesional);
                $profesional->activo = 0;
                $profesional->update();
                return Redirect::action('ProfesionalController@index')->with('message', 'Profesional eliminado con éxito.');
    }


}
