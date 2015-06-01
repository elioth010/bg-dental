<?php

class GuardiaController extends \BaseController {


    public function index()
    {
        $sede_id = Auth::user()->sede_id;

        if ($sede_id != 4) {
            if(null !== Input::get('cdate')){
                $cdate = explode("-", Input::get('cdate'));
                $mes = $cdate[1];
                $ano = $cdate[0];
            } else {
                $mes = date("m");
                $ano = date("Y");
            }

            $eventos = Guardias::where('fecha_guardia', 'LIKE', '%-'.$mes.'-%')->get(array('fecha_guardia', 'profesional_id'));
            $events = array();
            foreach($eventos as $evento){
                $profesionales = Profesional::find($evento->profesional_id);
                $events[$evento->fecha_guardia] = $profesionales->nombre.", ".$profesionales->apellido1;
            }

            $calendario = $this->getGuardiaCalendar($events);

            // dummy:
            $sede = Sedes::where('id', 1)->firstOrFail();
            return View::make('agenda.guardias')->with(array('calendario' => $calendario, 'sede' => $sede));
        } else {
            $sedes = Sedes::lists('nombre', 'id');

            return View::make('agenda.guardias_elegir_sede')->with('sedes' , $sedes);
        }
    }

    public function index_gps() //Guardia por sede...
    {
        $sede_id = Input::get('sede');
        $sede = Sedes::find($sede_id);
        if(null !== Input::get('cdate')){
        $cdate = explode("-", Input::get('cdate'));
        $mes = $cdate[1];
        $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }
        $eventos = Guardias::where('fecha_guardia', 'LIKE', '%-'.$mes.'-%')
                ->where('sede_id', $sede_id)->get(array('fecha_guardia', 'profesional_id'));
        $events = array();
        foreach($eventos as $evento){
            $profesionales = Profesional::find($evento->profesional_id);
            $events[$evento->fecha_guardia] = $profesionales->nombre.", ".$profesionales->apellido1;
        }

        $calendario = $this->getGuardiaCalendar($events);

        return View::make('agenda.guardias')->with('calendario' , $calendario)->with('sede', $sede);
    }

    public function create()
    {
        $sede_id = Auth::user()->sede_id;
        if($sede_id = 4){
            $sedes = Sedes::lists('nombre', 'id');
            return View::make('agenda.guardias_elegir_sede_a_crear')->with('sedes' , $sedes);
        } else {
        $sede = Sedes::find($sede_id);
        $profesionales = Profesional::get();
        $option_prof="";
        foreach($profesionales as $i=>$profesionales){
                $option_prof .= "<option value =".$profesionales->id.">Dr. ".$profesionales->apellido1." ".$profesionales->apellido1."</option>";
        }

        if(null !== Input::get('cdate')){
        $cdate = explode("-", Input::get('cdate'));
        $mes = $cdate[1];
        $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }
//            $numero = 1;
//        var_dump($ano);
        $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        $i = 1;
        $events = array();
        $date;

        while($i<=$numero){
            $select_prof = "<select class = \"select_prof\" name = \"profesional_id-" . $i . "\">" . $option_prof . "</select>";
            $date_in = $ano."-".$mes."-".$i;
            $input = '<input  type = "hidden" name="dia-'.$i.'" value= "'.$date_in.'">';
            $events[$date_in] = array($input, $select_prof);
            $i++;
        }
        //            for($i;$i<=$numero;$i++){
        //                  $date_in = $ano."-".$mes."-".$i;
        //                  $input = "<input  type = \"hidden\" name=\"dia\" value= ".$date_in.">";
        //                  $events[$date_in] = array($input, $select_prof);
        //            }

        $calendario = $this->getGuardiaCalendar($events, '/guardia/create');

        return View::make('agenda.crear_guardias')->with('calendario', $calendario)->with('numero_dias', $numero)->with('sede', $sede);
        }
    }

    public function create_gps()
    {
        $sede_id = Input::get('sede');
        $sede = Sedes::find($sede_id);
        //$profesionales = Profesional::where('sede_id', $sede_id)->get();
        $profesionales = Profesional::leftJoin('sedes_profesionales' , 'sedes_profesionales.profesional_id', '=' , 'profesionales.id')->where('sedes_profesionales.sede_id', $sede_id)->get();
        $option_prof="";
        foreach($profesionales as $i=>$profesionales){
                $option_prof .= "<option value =".$profesionales->id.">Dr. ".$profesionales->apellido1." ".$profesionales->apellido1."</option>";
        }

        if(null !== Input::get('cdate')){
        $cdate = explode("-", Input::get('cdate'));
        $mes = $cdate[1];
        $ano = $cdate[0];
        } else {
            $mes = date("m");
            $ano = date("Y");
        }
//            $numero = 1;
//        var_dump($ano);
        $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        $i = 1;
        $events = array();
        $date;

        while($i<=$numero){
            $select_prof = "<select class = \"select_prof\" name = \"profesional_id-" . $i . "\">" . $option_prof . "</select>";
            $date_in = $ano."-".$mes."-".$i;
            $input = '<input  type = "hidden" name="dia-'.$i.'" value= "'.$date_in.'">';
            $events[$date_in] = array($input, $select_prof);
            $i++;
        }
        //            for($i;$i<=$numero;$i++){
        //                  $date_in = $ano."-".$mes."-".$i;
        //                  $input = "<input  type = \"hidden\" name=\"dia\" value= ".$date_in.">";
        //                  $events[$date_in] = array($input, $select_prof);
        //            }

        $calendario = $this->getGuardiaCalendar($events, '/guardia/create');

        return View::make('agenda.crear_guardias')->with('calendario', $calendario)->with('numero_dias', $numero)->with('sede', $sede);
    }

    public function store()
    {
        $guardias = Input::all();
        $i = 1;
        //TODO: loop
        while($i<=$guardias['numero_dias']){
            $evento = new Guardias;
            $evento->fecha_guardia = $guardias["dia-".$i];
            $evento->profesional_id = $guardias['profesional_id-'.$i];
            $evento->sede_id = $guardias['sede_id'];
            $evento->save();
            $i++;
            }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    private function getGuardiaCalendar($events, $basepath = '/guardia') {
        $cal = Calendar::make();
        $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
        //$cal->setStartWeek('L');
        $cal->setBasePath($basepath); // Base path for navigation URLs
        $cal->setDate(Input::get('cdate')); //Set starting date
        $cal->showNav(true); // Show or hide navigation
        $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
        $cal->setEvents($events); // Receives the events array
        $cal->setTableClass('table_cal'); //Set the table's class name

        return $cal->generate();
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
