<!DOCTYPE html>
<html lang="en">

  <head>
@include('includes.head')
@yield('metas')
@yield('javascripts')
@yield('ceeseeses')
  </head>

 <body>
 <div id="wrapper">
     <header>
 	<div class="welcome">
         Bienvenida/o <span class="bold">{{{ isset(Auth::user()->name) ? Auth::user()->lastname : Auth::user()->firstname.' '.Auth::user()->lastname  }}}</span><br>
     <?php $profesional = Profesional::where('user_id', Auth::user()->id)->first();
     if(isset($profesional)) {
         echo "Profesional: ".$profesional->nombre.", ".$profesional->apellido1." ".$profesional->apellido2;
     } else {
         echo "Este usuario no tiene un profesional asignado";
     }
     ?></div>
         <div class="logo"></div>
         <div class="exit">

<!--  {{ HTML::link('users/logout', HTML::image('imagenes/exit.png', 'Salir')) }} -->

 {{ html_entity_decode( HTML::link("users/logout", HTML::image("imagenes/exit.png", "Salir", array('title' => 'SALIR')) ) ) }}
 </div>
 
 </header>

                    @if(Auth::check())

 <div id="menu">

                <ul class="nav">

                    @if(Auth::user()->isAdmin())
                    <li>{{ HTML::link('#', 'ADMINISTRACIÓN') }}
                        <ul>
                            <li>{{ HTML::link('users/dashboard', 'PANEL USUARIOS') }}</li>
                            <li>{{ HTML::link('users/register', 'REGISTRAR') }}</li>
                            <li>{{ HTML::linkAction('CompaniasController@index', 'COMPAÑÍAS') }}</li>
                            <li>{{ HTML::linkAction('ProfesionalController@index', 'PROFESIONALES') }}</li>
                            <li>{{ HTML::linkAction('EspecialidadController@index', 'ESPECIALIDADES') }}</li>
                            <li>{{ HTML::linkAction('SedesController@index', 'SEDES') }}</li>
                            <li>{{ HTML::linkAction('OpcionesController@index', 'OPCIONES de QDENTAL') }}</li>
                        </ul>
                    </li>
                    @endif

                    <li>{{ HTML::linkAction('PacientesController@index', 'PACIENTES') }}
                    <ul>
                        <li>{{ HTML::linkAction('PacientesController@create', 'CREAR PACIENTES') }}</li>
                        <li>{{ HTML::linkAction('PacientesController@buscar', 'BUSCAR PACIENTES') }}</li>
                    </ul>
                    </li>
                    <li>{{ HTML::linkAction('TratamientosController@index', 'TRATAMIENTOS') }}
                        <ul>
                            {{--<li>{{ HTML::linkAction('TratamientosController@create', 'CREAR TRATAMIENTOS') }}</li>
                            <li>{{ HTML::linkAction('GruposController@index', 'GRUPOS DE TRATAMIENTOS') }}</li>--}}
                            @if(Auth::user()->isAdmin())
                            <li>{{ HTML::linkAction('GruposController@create', 'CREAR GRUPO DE TRATAMIENTOS') }}</li>
                            <li>{{ HTML::linkAction('TratamientosController@create', 'CREAR TRATAMIENTOS') }}</li>
                            @endif
                        </ul>
                    </li>
                    @if(Auth::user()->isProfesional() or Auth::user()->isAdmin())
                    <li>{{ HTML::link('#', 'PROFESIONALES') }}
                        <ul>
                            <li>{{ HTML::linkAction('Historial_clinicoController@index', 'HISTORIAL CLÍNICO') }}</li>
                            <li>{{ HTML::linkAction('FacturacionController@index', 'FACTURACIÓN') }}</li>
                            <li>{{ HTML::linkAction('EstadisticasController@index', 'ESTADÍSTICAS') }}</li>
                            <li>{{ HTML::linkAction('CobrosController@morosos', 'COBROS PENDIENTES') }}</li>

                        </ul>
                    </li>@endif
                    <li>{{ HTML::link('#', 'AGENDA') }}
                        <ul>
                            <li>{{ HTML::linkAction('TurnoController@index', 'TURNOS') }}</li>
                            <li>{{ HTML::linkAction('GuardiaController@index', 'GUARDIAS') }}</li>
                        </ul>
                    </li>

                  </ul>
			 </div>

			         @else
                     <div id="menu">
                     <ul class="nav"><li>{{ HTML::link('users/login', 'ENTRAR') }}</li></ul>
                     @endif


    <div class="container">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif

        @yield('contenido')



    </div>

 	<footer>
	@include('includes.footer')
 	</footer>
  </div>
  </body>
</html>
