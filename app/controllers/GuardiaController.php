<?php

class GuardiaController extends \BaseController {

	public function index()
	{
            $events = array(
                "2015-01-01 10:30:00" => array(
                    "Dr. Urbano",
                ),
                "2015-01-12 14:12:23" => array(
                    "Dra. Rocío",
                ),
                "2015-01-14 08:00:00" => array(
                    "Dr. Rodriguez de Moya",
                ),
            );
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
             /**
                
                
                
                $cal->setView(Input::get('cv')); //'day' or 'week' or null
                $cal->setStartEndHours(8,20); // Set the hour range for day and week view
                $cal->setTimeClass('ctime'); //Class Name for times column on day and week views
                $cal->setEventsWrap(array('<p>', '</p>')); // Set the event's content wrapper
                $cal->setDayWrap(array('<div>','</div>')); //Set the day's number wrapper
                $cal->setNextIcon('>>'); //Can also be html: <i class='fa fa-chevron-right'></i>
                $cal->setPrevIcon('<<'); // Same as above
                $cal->setDayLabels(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat')); //Label names for week days

                $cal->setDateWrap(array('<div>','</div>')); //Set cell inner content wrapper
                
                $cal->setHeadClass('table-header'); //Set top header's class name
                $cal->setNextClass('btn'); // Set next btn class name
                $cal->setPrevClass('btn'); // Set Prev btn class name
                
              **/
             $calendario = $cal->generate();
             //echo $calendario;
             return View::make('agenda.guardias')->with('calendario' , $calendario);
             
            
    }
        
        public function create()
	{
            $profesionales = Profesional::lists('id', 'nombre', 'apellido');
//            $events = array(); 
//            $cal = Calendar::make();
//             //$cal->setEvents($events);
//             $cal->setDayLabels(array('L', 'M', 'X', 'J', 'V', 'S', 'D'));
//             $cal->setStartWeek('L');
//             $cal->setBasePath('/guardia'); // Base path for navigation URLs
//             $cal->setDate(Input::get('cdate')); //Set starting date
//             $cal->showNav(true); // Show or hide navigation
//             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
//             $cal->setEvents($events); // Receives the events array
//             $cal->setTableClass('table_cal'); //Set the table's class name
//             $calendario = $cal->generate();
            //->with('calendario' , $calendario)
             return View::make('agenda.crear_guardias')->with('profesionales', $profesionales);
             
	}

	public function store()
	{
		//
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
