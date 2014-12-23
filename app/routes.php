<?php

// Route::get('/', function()
// {
// 	return View::make('hello');
// });
// La siguiente ruta es para ver las SQL-queries que se hacen en la app. En producción habrá que quitarlas.
Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});
Route::get('/', 'UsersController@getLogin');
Route::controller('users', 'UsersController');

Route::group(array('before' => 'auth'), function(){


Route::get('pacientes', 'PacientesController@index');
Route::get('pacientes/buscar', 'PacientesController@show');
Route::post('pacientes/busqueda', 'PacientesController@busqueda');
Route::get('populate', 'PopulateController@populate');
Route::get('pacientes/verficha-{numerohistoria}', 'PacientesController@verficha');
Route::get('pacientes/crear', 'PacientesController@crear');
Route::post('pacientes/guardar', 'PacientesController@store');
Route::post('pacientes/{numerohistoria}/editarficha', 'PacientesController@editarficha');



//Rutas tratamientos y grupos:

Route::get('tratamientos', 'TratamientosController@index');
Route::get('tratamientos/buscar', 'TratamientosController@show');
Route::post('tratamientos/busqueda', 'TratamientosController@busqueda');
Route::get('tratamientos/grupos', 'GruposController@index');
Route::get('tratamientos/creargrupo', 'GruposController@create');
Route::post('tratamientos/guardargrupo', 'GruposController@store');
Route::get('tratamientos/crear', 'TratamientosController@create');
Route::get('tratamientos/editar/{id}', 'TratamientosController@edit');
Route::post('tratamientos/guardar', 'TratamientosController@store');


//Rutas compañías:

Route::get('tratamientos/companias', 'CompaniasController@index');
Route::get('tratamientos/crearcompania', 'CompaniasController@create');
Route::post('tratamientos/guardarcompania', 'CompaniasController@store');


//Rutas presupuestos:

Route::get('pacientes/{numerohistoria}/presupuestos', 'PresupuestosController@verpresupuestos');
Route::get('pacientes/{numerohistoria}/crearpresupuesto', 'PresupuestosController@crearpresupuesto');
Route::post('pacientes/{numerohistoria}/guardarpresupuesto', 'PresupuestosController@store');

Route::post('pacientes/{numerohistoria}/ver_grupos', 'PresupuestosController@vergrupos');
Route::get('pacientes/{grupo_id}/findTratamiento',  'PresupuestosController@findTratamientos');
Route::get('presupuestos/{presupuesto_id}',  'PresupuestosController@verPresupuesto');



//rutas para llenar db de datos:

//creando compañías:
Route::get('crearcompanias', function() {
$comps = array('PRIVADO','MAPFRE','G.C. GRANDES COLECTIVOS','G.C COMP DENT CASER','G.C. CASER MOD.PLENA','G.C CASER POL.DENTAL','G.C.UNION MADRILEÑA','SÓLO MEDIFIATC GESTISEP','COSALUD','AVANT SALUD','COMPAÑÍAS BARCOS','C. EXTRANJERAS ','ASEPEYO1','EMBAJADA','LIBIA','ASEPEYO2','ASEPEYO','CARITAS B','CARITAS C','LABORATORIO','MAPFRE2','FIAT','GROUPAMA');	
foreach($comps as $comps) {
	$comps_codes = substr(strtolower($comps),0,10);
	$compania = new Companias;
	$compania->nombre = $comps;
	$compania->codigo = $comps_codes;
	$compania->save();
	echo $comps_codes."-".$comps."<br>";
}

});
Route::get('crearpresu', function() {
	$presupuesto = new Presupuestos;
	$presupuesto->nombre = "primer presupuesto";
	$presupuesto->numerohistoria = "7947";
	$presupuesto->save();
	$presupuesto->tratamientos()->attach(61,array('unidades'=> '1', 'desc_euros' => '10', 'pieza1' => '12'));
	

});


Route::get('creartrats', function() {
      $archivo = fopen(storage_path().'/tratamientos.csv', 'r');
      $grupo = "Grupo";
      $id_grupo = "X";
      while (( $data = fgetcsv($archivo, 2500, ';', '"')) !== FALSE)
      {
// 	    $grupo = "Grupo";
	    
	    $tratamiento = new Tratamientos;
	      if(strlen($data['0']) == 1)
		      {
			$grupo_id = $data['0'];
			$grupo_s = Grupos::where('id',$grupo_id)->first();
			$grupo = $grupo_s->nombre;
			$id_grupo = $grupo_s->id;
			echo "<h3> GRUPO: ".$grupo."</h3><p>";
		       } else {
			$codigo = $data['0'];
			$nombre = $data['1'];
			$precio = $data['3'];
			$precio_1 = $data['4'];
			$precio_2 = $data['5'];
			$precio_3 = $data['6'];
			$precio_4 = $data['7'];
			$precio_5 = $data['8'];
			$precio_6 = $data['9'];
			$precio_7 = $data['10'];
			$precio_8 = $data['11'];
			$precio_9 = $data['12'];
			$precio_10 = $data['13'];
			$precio_11 = $data['14'];
			$precio_12 = $data['15'];
			$precio_13 = $data['16'];
			$precio_14 = $data['17'];
			$precio_15 = $data['18'];
			$precio_16 = $data['19'];
			$precio_17 = $data['20'];
			$precio_18 = $data['21'];
			$precio_19 = $data['22'];
			$precio_20 = $data['23'];
			$precio_21 = $data['24'];
		       }
	    $tratamiento->precio_base = $precio;
	    $tratamiento->grupostratamientos_id = $id_grupo;
	    $tratamiento->codigo = $codigo;
	    $tratamiento->nombre = $nombre;
	    $tratamiento->save();
	    $tratamiento->companias()->attach(1, array('precio' => $precio_1));
	    $tratamiento->companias()->attach(2, array('precio' => $precio_2));
	    $tratamiento->companias()->attach(3, array('precio' => $precio_3));    
	    $tratamiento->companias()->attach(4, array('precio' => $precio_4));
	    $tratamiento->companias()->attach(5, array('precio' => $precio_5));
	    $tratamiento->companias()->attach(6, array('precio' => $precio_6));
	    $tratamiento->companias()->attach(7, array('precio' => $precio_7));
	    $tratamiento->companias()->attach(8, array('precio' => $precio_8));
	    $tratamiento->companias()->attach(9, array('precio' => $precio_9));
	    $tratamiento->companias()->attach(10, array('precio' => $precio_10));
	    $tratamiento->companias()->attach(11, array('precio' => $precio_11));
	    $tratamiento->companias()->attach(12, array('precio' => $precio_12));
	    $tratamiento->companias()->attach(13, array('precio' => $precio_13));
	    $tratamiento->companias()->attach(14, array('precio' => $precio_14));
	    $tratamiento->companias()->attach(15, array('precio' => $precio_15));
	    $tratamiento->companias()->attach(16, array('precio' => $precio_16));
	    $tratamiento->companias()->attach(17, array('precio' => $precio_17));
	    $tratamiento->companias()->attach(18, array('precio' => $precio_18));
	    $tratamiento->companias()->attach(19, array('precio' => $precio_19));
	    $tratamiento->companias()->attach(20, array('precio' => $precio_20));
	    $tratamiento->companias()->attach(21, array('precio' => $precio_21));
	    
	    //echo $grupo."-".$codigo."-".$nombre."-".$precio." - Precio MAPFRE: ".$precio_1."<br>";
      }
      
});



});