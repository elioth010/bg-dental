<?php

class GuardiaController extends \BaseController {
    
    
    

//    echo "<pre>";
//
//    print_r(dates_month(2,2012)); 
//
//    echo"</pre>"; 

	public function index()
	{
            $events = array(
                "2015-02-01 10:30:00" => array(
                    "Dr. Urbano",
                ),
                "2015-02-12 14:12:23" => array(
                    "Dra. Rocío",
                ),
                "2015-02-14 08:00:00" => array(
                    "Dr. Rodriguez de Moya",
                ),
            );
//            var_dump($events);
             $cal = Calendar::make();
             //$cal->setEvents($events);
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
             $cal->setStartWeek('L');
             $cal->setBasePath('/guardia'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
             return View::make('agenda.guardias')->with('calendario' , $calendario);
             
            
    }
        
        public function create()
	{
            $profesionales = Profesional::get();
            $select_prof = "<select>";
            foreach($profesionales as $profesionales){
                    $select_prof .= "<option name = \"id\" value =".$profesionales->id.">".$profesionales->nombre." ".$profesionales->apellido1." ".$profesionales->apellido2."</option>";
            }
            $select_prof .= "</select>";
            $mes = 2;
            $ano = 2015;
            $numero = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
            $i = 1;
            $events = array();
            $date;
            for($i;$i<=$numero;$i++){
                  $date_in = $ano."-".$mes."-".$i;
                  $input = "<input  type = \"hidden\" name=\"dia\" value= ".$date_in.">";
                  $events[$ano."-".$mes."-".$i] = array($input, $select_prof);
            }
             $cal = Calendar::make();
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
             $cal->setStartWeek('L');
             $cal->setBasePath('/guardia'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
             return View::make('agenda.crear_guardias')->with('calendario', $calendario);
             
	}

	public function store()
	{
		$guardias = Input::all();
                var_dump($guardias);
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
