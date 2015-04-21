<?php

class TurnoController extends \BaseController {
    
    	public function index()
	{
            
            if(null !== Input::get('cdate')){
            $cdate = explode("-", Input::get('cdate'));
            $mes = $cdate[1];
            $ano = $cdate[0];
            } else {
                $mes = date("m");
                $ano = date("Y");
            }
            $sede_id = Auth::user()->sede_id;
            //var_dump($sede_id);
            if($sede_id != 4){
            $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')->where('sede_id', $sede_id)->orderBy('fecha_turno')->get(array('fecha_turno', 'profesional_id'));
            
//             $events = array("2015-03-09 10:30:00" => array("Event 1","Event 2 <strong> with html</strong>",),"2015-03-09 14:12:23" => array("Event 3",),"2015-03-14 08:00:00" => array("Event 4",),);
            } else {
            //$eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')->orderBy('fecha_turno')->get(array('fecha_turno', 'profesional_id', 'sede_id'));
            //Elegir la sede de la que se quieren ver los turnos.
                $sedes = Sedes::lists('nombre', 'id');
                return View::make('agenda.turnos_elegir_sede')->with('sedes' , $sedes);
                
            }
            $events = array();
                foreach($eventos as $evento){
                    $profesionales = Profesional::find($evento->profesional_id);
                    $events[$evento->fecha_turno] = array($profesionales->nombre.", ".$profesionales->apellido1);
                }
            //var_dump($events);
            $cal = Calendar::make();
            //$cal->setEvents($events);
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
            //$cal->setStartWeek('L');
             $cal->setBasePath('/turno'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
              if($sede_id != 4){
                    return View::make('agenda.turnos')->with('calendario' , $calendario);
              } else {
                    return View::make('agenda.turnos_sedes')->with('calendario' , $calendario);
              }
            
    }
    
    public function index_tps() //Turno por sede...
	{
            
            if(null !== Input::get('cdate')){
            $cdate = explode("-", Input::get('cdate'));
            $mes = $cdate[1];
            $ano = $cdate[0];
            } else {
                $mes = date("m");
                $ano = date("Y");
            }
            $sede_id = Input::get('sede');
            $sede = Sedes::find($sede_id);
            
            $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')->where('sede_id', $sede_id)->orderBy('fecha_turno')->get(array('fecha_turno', 'profesional_id'));
            
//             $events = array("2015-03-09 10:30:00" => array("Event 1","Event 2 <strong> with html</strong>",),"2015-03-09 14:12:23" => array("Event 3",),"2015-03-14 08:00:00" => array("Event 4",),);
            
            $events = array();
                foreach($eventos as $evento){
                    $profesionales = Profesional::find($evento->profesional_id);
                    $events[$evento->fecha_turno] = array($profesionales->nombre.", ".$profesionales->apellido1);
                }
            //var_dump($events);
            $cal = Calendar::make();
            //$cal->setEvents($events);
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
            //$cal->setStartWeek('L');
             $cal->setBasePath('/turno'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
              
                    return View::make('agenda.turnos')->with('calendario' , $calendario)->with('sede', $sede);
             
            
    }
        
        public function create()
	{
            $sede_id = Auth::user()->sede_id;
            if($sede_id = 4){
                $sedes = Sedes::lists('nombre', 'id');
                return View::make('agenda.turnos_elegir_sede_a_crear')->with('sedes' , $sedes);
            } else {
            $profesionales = Profesional::where('sede_id', $sede_id)->get();
            //$sede_nombre = Sedes::lists('nombre')->where('sede_id', $sede_id);
            $option_prof="";
            foreach($profesionales as $i=>$profesionales){
                    $option_prof .= "<option value =".$profesionales->id.">Dr. ".$profesionales->apellido1."</option>";
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
                $select_prof_m = "<select class = \"select_prof\" name = \"profesional_id-m-" . $i . "\">" . $option_prof . "</select>";
                $date_in_m = $ano."-".$mes."-".$i." 10:00";
                $input_m = '<input  type = "hidden" name="dia-m-'.$i.'" value= "'.$date_in_m.'">';
                
                $select_prof_m2 = "<select class = \"select_prof\" name = \"profesional_id-m2-" . $i . "\">" . $option_prof . "</select><hr>";
                $date_in_m2 = $ano."-".$mes."-".$i." 10:01";
                $input_m2 = '<input  type = "hidden" name="dia-m2-'.$i.'" value= "'.$date_in_m2.'">';
                
                $select_prof_t = "<select class = \"select_prof\" name = \"profesional_id-t-" . $i . "\">" . $option_prof . "</select>";
                $date_in_t = $ano."-".$mes."-".$i." 13:00";
                $input_t = '<input  type = "hidden" name="dia-t-'.$i.'" value= "'.$date_in_t.'">';
                
                $select_prof_t2 = "<select class = \"select_prof\" name = \"profesional_id-t2-" . $i . "\">" . $option_prof . "</select>";
                $date_in_t2 = $ano."-".$mes."-".$i." 13:01";
                $input_t2 = '<input  type = "hidden" name="dia-t2-'.$i.'" value= "'.$date_in_t2.'">';
                
                
                
                $events1[$date_in_m] = array($input_m, $select_prof_m);
                $events2[$date_in_m2] = array($input_m2, $select_prof_m2);
                $events3[$date_in_t] = array($input_t, $select_prof_t);
                $events4[$date_in_t2] = array($input_t2, $select_prof_t2);
                $events = array_merge($events1, $events2, $events3, $events4);
                $i++;
            }
          
             $cal = Calendar::make();
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
             //$cal->setStartWeek('L');
             $cal->setBasePath('/turno/create'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
             return View::make('agenda.crear_turnos')->with(array('calendario' => $calendario, 'numero_dias' => $numero, 'sede_id'=> $sede_id));

	}
        }
        
         public function create_tps()
	{
            $sede_id = Input::get('sede');
            $sede = Sedes::find($sede_id);
            $profesionales = Profesional::leftJoin('sedes_profesionales' , 'sedes_profesionales.profesional_id', '=' , 'profesionales.id')->where('sedes_profesionales.sede_id', $sede_id)->get();
            //$sede_nombre = Sedes::lists('nombre')->where('sede_id', $sede_id);
            $option_prof="";
            foreach($profesionales as $i=>$profesionales){
                    $option_prof .= "<option value =".$profesionales->id.">Dr. ".$profesionales->apellido1."</option>";
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
                $select_prof_m = "<select class = \"select_prof\" name = \"profesional_id-m-" . $i . "\">" . $option_prof . "</select>";
                $date_in_m = $ano."-".$mes."-".$i." 10:00";
                $input_m = '<input  type = "hidden" name="dia-m-'.$i.'" value= "'.$date_in_m.'">';
                
                $select_prof_m2 = "<select class = \"select_prof\" name = \"profesional_id-m2-" . $i . "\">" . $option_prof . "</select><hr>";
                $date_in_m2 = $ano."-".$mes."-".$i." 10:01";
                $input_m2 = '<input  type = "hidden" name="dia-m2-'.$i.'" value= "'.$date_in_m2.'">';
                
                $select_prof_t = "<select class = \"select_prof\" name = \"profesional_id-t-" . $i . "\">" . $option_prof . "</select>";
                $date_in_t = $ano."-".$mes."-".$i." 13:00";
                $input_t = '<input  type = "hidden" name="dia-t-'.$i.'" value= "'.$date_in_t.'">';
                
                $select_prof_t2 = "<select class = \"select_prof\" name = \"profesional_id-t2-" . $i . "\">" . $option_prof . "</select>";
                $date_in_t2 = $ano."-".$mes."-".$i." 13:01";
                $input_t2 = '<input  type = "hidden" name="dia-t2-'.$i.'" value= "'.$date_in_t2.'">';
                
                
                
                $events1[$date_in_m] = array($input_m, $select_prof_m);
                $events2[$date_in_m2] = array($input_m2, $select_prof_m2);
                $events3[$date_in_t] = array($input_t, $select_prof_t);
                $events4[$date_in_t2] = array($input_t2, $select_prof_t2);
                $events = array_merge($events1, $events2, $events3, $events4);
                $i++;
            }
          
             $cal = Calendar::make();
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
             //$cal->setStartWeek('L');
             $cal->setBasePath('/turno/create'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
             return View::make('agenda.crear_turnos')->with(array('calendario' => $calendario, 'numero_dias' => $numero))->with('sede', $sede);

	}
        

	public function store()
	{
		$turnos = Input::all();
        //var_dump($turnos['numero_dias']);
        $i = 1;
        while($i<=$turnos['numero_dias']){
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-m-".$i];
            $evento->profesional_id = $turnos['profesional_id-m-'.$i] ;
            $evento->sede_id = $turnos['sede_id'];
            // TODO: mañana
            $evento->save();
            $i++;
        }
        $i2= 1;
         while($i2<=$turnos['numero_dias']){
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-m2-".$i2];
            $evento->profesional_id = $turnos['profesional_id-m2-'.$i2] ;
            // TODO: mañana
            $evento->sede_id = $turnos['sede_id'];
            $evento->save();
            $i2++;
        }
        $ii = 1;
        while($ii<=$turnos['numero_dias']){
            
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-t-".$ii];
            $evento->profesional_id = $turnos['profesional_id-t-'.$ii] ;
            // TODO: tarde
            $evento->sede_id = $turnos['sede_id'];
            $evento->save();
            $ii++;
        }
        $ii2 = 1;
        while($ii2<=$turnos['numero_dias']){
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-t2-".$ii2];
            $evento->profesional_id = $turnos['profesional_id-t2-'.$ii2] ;
            // TODO: tarde
            $evento->sede_id = $turnos['sede_id'];
            $evento->save();
            $ii2++;
        }
        
        return Redirect::to('turno');
	}

	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		//
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
