<?php

class GuardiaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $events = array(
                "2015-01-01 10:30:00" => array(
                    "Event 1",
                    "Event 2 <strong> with html</strong>",
                ),
                "2015-01-12 14:12:23" => array(
                    "Event 3",
                ),
                "2015-01-14 08:00:00" => array(
                    "Event 4",
                ),
            );
             $cal = Calendar::make();
             //$cal->setEvents($events);
             $cal->setDayLabels(array('L', 'M', 'X', 'J', 'V', 'S', 'D'));
             $cal->setStartWeek('L');
             $cal->setBasePath('/guardia'); // Base path for navigation URLs
             $cal->setDate(Input::get('cdate')); //Set starting date
             $cal->showNav(true); // Show or hide navigation
             $cal->setMonthLabels(array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre')); //Month names
             $cal->setEvents($events); // Receives the events array
             $cal->setTableClass('table'); //Set the table's class name
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
             return View::make('agenda.guardias')->with('calendario' , $calendario);
             
            
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
