<?php
// La siguiente ruta es para ver las SQL-queries que se hacen en la app. En producción habrá que quitarlas.
// Event::listen('illuminate.query', function($query)
// {
//    var_dump($query);
// });
if(Auth::check()) //si usuario logeado cambiamos la ruta de acceso al servidor /
{
    if(Auth::user()->isAdmin())
    {
        Route::get('/', 'PacientesController@index');

    } elseif(Auth::user()->isProfesional())
    {
        Route::get('/', 'Historial_clinicoController@index');

    } elseif(Auth::user()->isRecepcion())
    {
        Route::get('/', 'PacientesController@index');

    } else {
        Route::get('/', 'UsersController@getLogin');

    }
} else {

    Route::get('/', 'UsersController@getLogin');

}

Route::controller('users', 'UsersController');
Route::get('password/reset/{id}', 'RemindersController@show');
Route::post('password/reset/{token}', 'RemindersController@update');

Route::resource('password', 'RemindersController');
//Route::get('users/editar/{id}', 'UsersController@edit');


Route::group(array('before' => 'auth'), function() {

    Route::get('paciente/buscar', 'PacientesController@buscar');
    Route::get('paciente/busqueda', 'PacientesController@busqueda');
    Route::resource('paciente', 'PacientesController');

    //Route::get('populate', 'PopulateController@populate');

    //Rutas tratamientos y grupos:
    Route::get('tratamientos', 'TratamientosController@index');
    Route::post('tratamientos/index_tpg', 'TratamientosController@index_tpg');
    Route::get('tratamientos/buscar', 'TratamientosController@show');
    Route::get('tratamientos/busqueda', 'TratamientosController@busqueda');
    Route::get('tratamientos/grupos', 'GruposController@index');
    Route::get('tratamientos/creargrupo', 'GruposController@create');
    Route::post('tratamientos/guardargrupo', 'GruposController@store');
    Route::get('tratamientos/editargrupo/{id}', 'GruposController@edit');
    Route::post('tratamientos/actualizargrupo/{id}', 'GruposController@update');
    Route::post('tratamientos/eliminargrupo/{id}', 'GruposController@destroy');
    Route::get('tratamientos/crear', 'TratamientosController@create');
    Route::get('tratamientos/editar/{id}', 'TratamientosController@edit');
    Route::post('tratamientos/guardar', 'TratamientosController@store');
    Route::post('tratamientos/guardartratamiento/{id}', 'TratamientosController@update');
    Route::get('tratamientos/borrartratamiento/{id}', 'TratamientosController@destroy');

    //Rutas compañías:
    Route::get('tratamientos/companias', 'CompaniasController@index');
    Route::get('tratamientos/crearcompania', 'CompaniasController@create');
    Route::post('tratamientos/guardarcompania', 'CompaniasController@store');
    Route::get('tratamientos/editarcompania/{id}', 'CompaniasController@edit');
    Route::post('tratamientos/modificarcompania/{id}', 'CompaniasController@update');
    Route::get('tratamientos/borrarcompania/{id}', 'CompaniasController@destroy');

    //Rutas presupuestos:
    Route::get('pacientes/{numerohistoria}/presupuestos', 'PresupuestosController@verpresupuestos');
    Route::get('pacientes/{numerohistoria}/presupuesto/{presupuesto_id}',  'PresupuestosController@verPresupuesto');
    Route::post('pacientes/{numerohistoria}/presupuesto/{presupuesto_id}',  'PresupuestosController@guardarObservaciones');
    Route::post('pacientes/{numerohistoria}/presupuesto/{presupuesto_id}/coste_lab',  'PresupuestosController@guardarCoste_lab');
    Route::get('pacientes/{numerohistoria}/presupuesto/{presupuesto_id}/borrar',  'PresupuestosController@borrarPresupuesto');
    Route::get('pacientes/{numerohistoria}/presupuesto/{presupuesto_id}/imprimir',  'PresupuestosController@imprimirPresupuesto');
    Route::get('pacientes/{numerohistoria}/presupuesto/{presupuesto_id}/imprimirpdf',  'PresupuestosController@imprimirPDF');
    Route::get('pacientes/{numerohistoria}/presupuesto/{presupuesto_id}/verpdf',  'PresupuestosController@verPDF');
    Route::get('pacientes/{numerohistoria}/crearpresupuesto', 'PresupuestosController@crearpresupuesto');
    Route::get('pacientes/{numerohistoria}/crearpresupuesto/{presupuesto}', 'PresupuestosController@editarPresupuesto');
    Route::get('pacientes/{numerohistoria}/presupuesto/{presupuesto}/aceptar', 'PresupuestosController@aceptarPresupuesto');
    Route::get('pacientes/{numerohistoria}/presupuesto/{presupuesto}/aceptar/{tratamiento}', 'PresupuestosController@aceptarTratamientoPresupuesto');
    Route::post('pacientes/{numerohistoria}/guardarpresupuesto', 'PresupuestosController@store');

    Route::post('pacientes/{numerohistoria}/ver_grupos', 'PresupuestosController@vergrupos');
    Route::get('pacientes/{grupo_id}/findTratamiento',  'PresupuestosController@findTratamientos');

    //Rutas Profesionales:
    Route::get('profesional/borrarprofesional/{id}', 'ProfesionalController@destroy');
    Route::resource('profesional', 'ProfesionalController');

    //Rutas Especialidades:
    Route::resource('especialidad', 'EspecialidadController');

    //Rutas guardias
    Route::get('guardia/create/{sede}', array('as' => 'createSede', 'uses' => 'GuardiaController@createSede'));
    Route::get('guardia/create/{sede}/{year}/{month}', array('as' => 'createMonth', 'uses' => 'GuardiaController@createMonth'));
    Route::get('guardia/{sede}/{year}/{month}/edit', array('as' => 'editMonth', 'uses' => 'GuardiaController@editMonth'));
    Route::get('guardia/{sede}/{year}/{month}', array('as' => 'showMonth', 'uses' => 'GuardiaController@showMonth'));
    Route::put('guardia/{sede}/{year}/{month}', array('as' => 'updateMonth', 'uses' => 'GuardiaController@updateMonth'));
    Route::post('guardia/{sede}/{year}/{month}', array('as' => 'storeMonth', 'uses' => 'GuardiaController@storeMonth'));
    Route::get('guardia/listado', 'GuardiaController@listado_g');
    Route::post('guardia/listado', 'GuardiaController@listado_gf');
    Route::resource('guardia', 'GuardiaController');

    //Rutas turnos
    Route::get('turno/createdummy', 'TurnoController@createdummy');
    Route::get('turno/{sede}/{year}/{month}', array('as' => 'showMonth', 'uses' => 'TurnoController@showMonth'));
    Route::put('turno/{sede}/{year}/{month}', array('as' => 'updateMonth', 'uses' => 'TurnoController@updateMonth'));
    Route::get('/turnos/incidencias', 'TurnoController@incidencias');
    Route::put('incidencia/{sede}/{year}/{month}', array('as' => 'updateIncidencia', 'uses' => 'TurnoController@updateIncidencia'));
    Route::resource ('turno', 'TurnoController');

    //Rutas sedes
    Route::resource ('sede', 'SedesController');

    //Rutas tipos de tratamientos
    Route::resource ('tipos', 'TiposTratamientosController');

    //Rutas para Historiales clínicos
    Route::get('historial_clinico/busqueda', 'Historial_clinicoController@busqueda');
    Route::post('historial_clinico/coste_lab/{id}', 'Historial_clinicoController@coste_lab');
    Route::post('historial_clinico/cobrar/{id}', 'Historial_clinicoController@cobrar');
    Route::post('historial_clinico/ayudantia', 'Historial_clinicoController@store_ayudantia');
    Route::post('historial_clinico/eliminar', 'Historial_clinicoController@destroy');
    Route::post('historial_clinico/elegir_prof', 'Historial_clinicoController@elegir_prof');
    Route::post('historial_clinico/asignar_prof', 'Historial_clinicoController@asignar_prof');
    Route::resource('historial_clinico', 'Historial_clinicoController');

    //Rutas para facturación
    Route::get('facturacion/nocobrado', 'FacturacionController@index_nc');
    Route::resource('facturacion', 'FacturacionController');

    //Rutas de estadisticas
    Route::resource('estadisticas', 'EstadisticasController');

    //Rutas sala de espera

    Route::resource('espera', 'EsperaController');

    //Rutas cobros
    Route::get('cobros/pdc', 'CobrosController@morosos');
    Route::post('cobros/anticipo/{id}', 'CobrosController@anticipo');
    Route::resource('cobros', 'CobrosController');

    //Rutas opciones
    Route::resource('opciones', 'OpcionesController');

    //rutas para llenar db de datos:
    //importando pacientes:
    Route::get('import_pacientes', function(){
        $archivo = fopen(storage_path().'/pacientes_2015', 'r');
        while (( $paciente = fgetcsv($archivo, 2500, ',')) !== FALSE) {
            $pacs = new Pacientes;
            $compania = $paciente[6];
            }
    });

    //creando compañías:
    Route::get('crearcompanias', function() {
        $archivo = fopen(storage_path().'/companias.csv', 'r');
        while (( $comps = fgetcsv($archivo, 2500, ',')) !== FALSE)
        {
            $compas = new Companias;
            $compas = $comps[0];
            $siexiste = Companias::where('nombre','LIKE', '%'.$compas.'%')->first();
            if(empty($siexiste)) {
                echo "Crear compañía: ".$compas."<br>";
                $compas_codes = substr(strtolower($compas),0,10);
                echo $compas_codes."<br>";
                $compania = new Companias;
                $compania->nombre = $compas;
                $compania->codigo = $compas_codes;
                $compania->save();
            } else {
                echo "Compañía ".$compas." ya existe <br>";
            }
        }
    });

    Route::get('creartcps', function() {
        $archivo = fopen(storage_path().'/tcps.csv', 'r');
        while (( $tcps = fgetcsv($archivo, 2500, ';')) !== FALSE)
        {
            $tratamiento = new Tratamientos;
            $cod_trat = $tcps[0];
            $nombre_trat = $tcps[1];
            $siexiste_tcp = Tratamientos::where('codigo',$cod_trat)->lists('id');
            if(empty($siexiste_tcp)){
                echo "Crear Tratamientos: ".$cod_trat."<br>";
                $tratamiento->nombre = $nombre_trat;
                $tratamiento->codigo = $cod_trat;
                $tratamiento->activo = 1;
                $tratamiento->save();
            } else {
                echo "Tratamiento ".$cod_trat." ya existe <br>";
            }
        }
    });

    Route::get('asignarprecios', function() {
        $archivo = fopen(storage_path().'/tcps.csv', 'r');
        while (( $tcps = fgetcsv($archivo, 1000, ';')) !== FALSE)
        {
            $cod_trat = $tcps[0];
            $comp = $tcps[4];

            $id_comp = Companias::where('nombre','LIKE', '%'.$comp.'%')->lists('id');
            $id_comp = $id_comp[0];
            //        echo $id_comp[0]."<br>";

            $precio = $tcps[2];

            $id_tratamiento = Tratamientos::where('codigo',$cod_trat)->first();
            $siexiste = Precios::where('tratamientos_id', $id_tratamiento->id)->where('companias_id', $id_comp)->lists('id');
            if(empty($siexiste)){

                Tratamientos::find($id_tratamiento->id)->precios()->attach($id_comp, array('precio' => $precio));
                //echo "Añadido tratamiento ".$id_tratamiento->nombre." a compañía ".$id_comp." precio: ".$precio."<br>";
                //$tratamiento->precios()->attach($id_comp, array('precio' => $precio));
            }
            else {
                echo "Precio para esta compañía y tratamientos ya existe";
            }
        }
    });

    Route::get('crearpresu', function() {
        $presupuesto = new Presupuestos;
        $presupuesto->nombre = "primer presupuesto";
        $presupuesto->numerohistoria = "7947";
        $presupuesto->save();
        $presupuesto->tratamientos()->attach(61,array('unidades'=> '1', 'descuento' => '10', 'piezas' => '12'));
    });

    Route::get('creartrats', function() {
        $archivo = fopen(storage_path().'/l.csv', 'r');
        $grupo = "Grupo";
        $id_grupo = "X";
        while (( $data = fgetcsv($archivo, 2500, ';', '"')) !== FALSE)
        {
            $grupo = "Grupo";
            $codigo = $data['0'];
            $nombre = $data['1'];
            $precio = $data['3'];
            $precio_1 = $data['4'];
            $precio_2 = $data['5'];
            $precio_3 = $data['6'];
            $precio_4 = $data['7'];
            $precio_5 = $data['8'];
            $precio_6 = $data['9'];
            $id_grupo = $data['10'];
            $tratamiento = new Tratamientos;
            $tratamiento->precio_base = $precio;
            $tratamiento->grupostratamientos_id = $id_grupo;
            $tratamiento->codigo = $codigo;
            $tratamiento->nombre = $nombre;
            $tratamiento->save();
            $tratamiento->companias()->attach(1, array('precio' => $precio));
            $tratamiento->companias()->attach(2, array('precio' => $precio_1));
            $tratamiento->companias()->attach(3, array('precio' => $precio_2));
            $tratamiento->companias()->attach(4, array('precio' => $precio_3));
            $tratamiento->companias()->attach(5, array('precio' => $precio_4));
            $tratamiento->companias()->attach(6, array('precio' => $precio_5));
            $tratamiento->companias()->attach(7, array('precio' => $precio_6));
        }
    });

});
