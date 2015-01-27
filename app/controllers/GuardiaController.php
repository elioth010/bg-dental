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
             //$cal->setDayLabels(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'));
             echo $cal->generate();
            
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
