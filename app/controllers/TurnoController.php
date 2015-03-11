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
            $eventos = Turnos::where('fecha_turno', 'LIKE', '%-'.$mes.'-%')->orderBy('fecha_turno')->get(array('fecha_turno', 'profesional_id'));
            
            $events = array();
            foreach($eventos as $evento){
                $profesionales = Profesional::find($evento->profesional_id);
                $events[$evento->fecha_turno] = $profesionales->nombre.", ".$profesionales->apellido1;
            }
            var_dump($events);
            $cal = Calendar::make();
             //$cal->setEvents($events);
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
             $cal->setStartWeek('L');
             $cal->setBasePath('/turno'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
             return View::make('agenda.turnos')->with('calendario' , $calendario);
             
            
    }
        
        public function create()
	{
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
                $select_prof_m = "<select class = \"select_prof\" name = \"profesional_id-m-" . $i . "\">" . $option_prof . "</select>";
                $date_in_m = $ano."-".$mes."-".$i." 10:00";
                $input_m = '<input  type = "hidden" name="dia-m-'.$i.'" value= "'.$date_in_m.'">';
                
                $select_prof_t = "<select class = \"select_prof\" name = \"profesional_id-t-" . $i . "\">" . $option_prof . "</select>";
                $date_in_t = $ano."-".$mes."-".$i." 13:00";
                $input_t = '<input  type = "hidden" name="dia-t-'.$i.'" value= "'.$date_in_t.'">';
                
                $events1[$date_in_m] = array($input_m, $select_prof_m);
                $events2[$date_in_t] = array($input_t, $select_prof_t);
                $events = array_merge($events1, $events2);
                $i++;
            }
          
             $cal = Calendar::make();
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
             $cal->setStartWeek('L');
             $cal->setBasePath('/turno/create'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
             return View::make('agenda.crear_turnos')->with(array('calendario' => $calendario, 'numero_dias' => $numero));

	}

	public function store()
	{
		$turnos = Input::all();
        var_dump($turnos['numero_dias']);
        $i = 1;
        while($i<=$turnos['numero_dias']){
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-m-".$i];
            $evento->profesional_id = $turnos['profesional_id-m-'.$i] ;
            // TODO: mañana
            $evento->save();
            $i++;
        }
        $ii = 1;
        while($ii<=$turnos['numero_dias']){
            $evento = new Turnos;
            $evento->fecha_turno = $turnos["dia-t-".$ii];
            $evento->profesional_id = $turnos['profesional_id-t-'.$ii] ;
            // TODO: tarde
            $evento->save();
            $ii++;
        }
        var_dump($turnos['numero_dias']);
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
