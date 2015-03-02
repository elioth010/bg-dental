<?php

class GuardiaController extends \BaseController {
    
    
    

//    echo "<pre>";
//
//    print_r(dates_month(2,2012)); 
//
//    echo"</pre>"; 
//$events = array(
//                "2015-02-01 10:30:00" => array(
//                    "Dr. Urbano",
//                ),
//                "2015-02-12 14:12:23" => array(
//                    "Dra. Rocío",
//                ),
//                "2015-02-14 08:00:00" => array(
//                    "Dr. Rodriguez de Moya",
//                ),
//            );
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
            $eventos = Guardias::where('fecha_guardia', 'LIKE', '%-'.$mes.'-%')->get(array('fecha_guardia', 'profesional_id'));
            
            $events = array();
            foreach($eventos as $evento){
                
                $profesionales = Profesional::find($evento->profesional_id);
                $events[$evento->fecha_guardia] = $profesionales->nombre.", ".$profesionales->apellido1;
            }
            var_dump($events);
            
            
            
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
             $cal = Calendar::make();
             $cal->setDayLabels(array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));
             $cal->setStartWeek('L');
             $cal->setBasePath('/guardia/create'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table_cal'); //Set the table's class name
             $calendario = $cal->generate();
             return View::make('agenda.crear_guardias')->with('calendario', $calendario)->with('numero_dias', $numero);
             
	}

	public function store()
	{
		$guardias = Input::all();
                $i = 1;
                while($i<=$guardias['numero_dias']){
                    $evento = new Guardias;
                    $evento->fecha_guardia = $guardias["dia-".$i];
                    $evento->profesional_id = $guardias['profesional_id-'.$i] ;
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


	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}


}
