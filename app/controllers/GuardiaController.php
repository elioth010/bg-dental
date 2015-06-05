<?php

class GuardiaController extends \BaseController {

    public function index() {
        $user = User::where('id', Auth::id())->firstOrFail();
        $sede_ids = array();
        foreach($user->sedes as $sede) {
            $sede_ids[] = $sede->id;
        }

        if (in_array(4, $sede_ids)) {
            $sedes = Sedes::where('id', '!=', 4)->get();
        } else {
            $sedes = Sedes::whereIn('id', $sede_ids)->get();
        }

        return View::make('guardias.index')->with(array('sedes' => $sedes));
    }

    public function create() {

    }

    public function createSede($sede_id) {
        $month = date("m");
        $year = date("Y");
        return Redirect::action('GuardiaController@createMonth', array($sede_id, $year, $month));
    }

    public function createMonth($sede_id, $year, $month) {

        if ($sede_id == 4){
            return Redirect::action('GuardiaController@index');
        }

        $sede = Sedes::where('id', $sede_id)->firstOrFail();

        $events = $this->getHtmlProfsSelectCreate($year, $month);
        $calendario = $this->getGuardiaCalendar($events);

        return View::make('guardias.create')->with(array('calendario' => $calendario, 'sede' => $sede,
                                                               'year' => $year, 'month' => $month));
    }

    private function getHtmlProfsSelect($guardias) {
        $options = $this->getHtmlProfsOptions($guardias);
        $selects = array();

        foreach ($options as $fecha => $option) {
            $day = explode('-', $fecha)[2];
            $selects[$fecha] = "<select class = \"select_prof\" name = \"profesional_id-" . $day . "\">" . $options[$fecha] . "</select>";
        }

        return $selects;
    }

    private function getHtmlProfsOptions($guardias) {
        $options = array();
        $profesionales = Profesional::where('especialidades_id', 1)->get();

        foreach($guardias as $guardia) {
            $options[$guardia->fecha_guardia] = "";

            foreach($profesionales as $profesional) {
                $selected = $profesional->id == $guardia->profesional_id ? "selected" : "";
                $options[$guardia->fecha_guardia] .= "<option value=\"$profesional->id\" $selected>Dr. $profesional->nombre $profesional->apellido1</option>";
            }
        }

        return $options;
    }

    private function getHtmlProfsSelectCreate($year, $month) {
        $selects = array();
        $profesionales = Profesional::where('especialidades_id', 1)->get();

        $options = "";
        foreach($profesionales as $i => $profesional) {
            $options .= "<option value=".$profesional->id.">Dr. ".$profesional->nombre." ".$profesional->apellido1."</option>";
        }

        $d = 1;
        $dias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        while($d <= $dias) {
            $fecha = date('Y-m-d', mktime(0, 0, 0, $month, $d, $year));
            $selects[$fecha] = "<select class = \"select_prof\" name = \"profesional_id-" . $d . "\">" . $options . "</select>";
            $d++;
        }

        return $selects;
    }


    public function storeMonth($sede_id, $year, $month) {

        foreach(Input::all() as $key => $profesional_id) {
            if (strpos($key, 'profesional_id-') === 0) {
                $day = explode("-", $key)[1]; // profesional_id-DD

                $guardia = new Guardias;
                $guardia->fecha_guardia = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
                $guardia->sede_id = $sede_id;
                $guardia->profesional_id = $profesional_id;
                $guardia->save();
            }
        }

        return Redirect::action('GuardiaController@showMonth', array($sede_id, $year, $month));
    }

    public function show($sede_id)
    {
        if (Input::has('cdate')) {
            $cdate = explode('-', Input::get('cdate'));
            return Redirect::action('GuardiaController@showMonth', array($sede_id, $cdate[0], $cdate[1]));
        }

        $month = date("m");
        $year = date("Y");
        return Redirect::action('GuardiaController@showMonth', array($sede_id, $year, $month));
    }

    public function showMonth($sede_id, $year, $month) {
        if (Input::has('cdate')) {
            $cdate = explode('-', Input::get('cdate'));
            return Redirect::action('GuardiaController@showMonth', array($sede_id, $cdate[0], $cdate[1]));
        }

        if ($sede_id == 4) { // Todas
            return Redirect::action('GuardiaController@index');
        }

        $sede = Sedes::where('id', $sede_id)->firstOrFail();

        $guardias = Guardias::where('fecha_guardia', 'LIKE', "$year-$month-%")
                                ->where('sede_id', $sede_id)
                                ->orderBy('fecha_guardia', 'profesional_id')
                                ->get();

        //-----------------------------------------
        // Si no existe una guardia para ese mes, crearla
        if (count($guardias) == 0) {
            return Redirect::action('GuardiaController@createMonth', array($sede_id, $year, $month));
        }

        $events = array();
        foreach($guardias as $guardia){
            $profesional = Profesional::find($guardia->profesional_id);
            $events[$guardia->fecha_guardia] = $profesional->nombre.", ".$profesional->apellido1;
        }

        $calendario = $this->getGuardiaCalendar($events, '/guardia/' . $sede_id);

        return View::make('guardias.show')->with(array('calendario' => $calendario, 'sede' => $sede, 'year' => $year, 'month' => $month));
    }

    public function edit($id)
    {

    }


    public function editMonth($sede_id, $year, $month) {
        if ($sede_id == 4){
            return Redirect::action('GuardiaController@index');
        }

        $sede = Sedes::where('id', $sede_id)->firstOrFail();
        $guardias = Guardias::where('fecha_guardia', 'LIKE', "$year-$month-%")
                                ->where('sede_id', $sede_id)
                                ->orderBy('fecha_guardia')
                                ->get();

        $events = $this->getHtmlProfsSelect($guardias);
        $calendario = $this->getGuardiaCalendar($events);

        return View::make('guardias.edit')->with(array('calendario' => $calendario, 'sede' => $sede,
                                                               'year' => $year, 'month' => $month));

    }

    private function getGuardiaCalendar($events, $basepath = '/guardia') {
        $cal = Calendar::make();
        $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
        $cal->setBasePath($basepath); // Base path for navigation URLs
        $cal->setDate(Input::get('cdate')); //Set starting date
        $cal->showNav(true); // Show or hide navigation
        $cal->setEventsWrap(array('', ''));
        $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
        $cal->setEvents($events); // Receives the events array
        $cal->setTableClass('table_cal'); //Set the table's class name

        return $cal->generate();
    }

    public function update($id)
    {
        //
    }

    public function updateMonth($sede_id, $year, $month) {

        foreach(Input::all() as $key => $profesional_id) {
            if (strpos($key, 'profesional_id-') === 0) {
                $day = explode("-", $key)[1]; // profesional_id-DD

                $date = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
                $guardia = Guardias::where('sede_id', $sede_id)->where('fecha_guardia', $date)->firstOrFail();
                $guardia->profesional_id = $profesional_id;
                $guardia->update();
            }
        }

        return Redirect::action('GuardiaController@showMonth', array($sede_id, $year, $month));
    }

    public function destroy($id)
    {
        //
    }


}
