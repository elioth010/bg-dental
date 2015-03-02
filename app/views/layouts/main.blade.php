<!DOCTYPE html>
<html lang="en">

  <head>
@include('includes.head')
@yield('javascripts')
  </head>

 <body>
 <div id="wrapper">
 <header>
 <div class="logo"></div>
 {{ HTML::link('users/logout', 'Salir') }}
 </header>

                    @if(Auth::check())

 <div id="menu">

                <ul class="nav">
                    
                    @if(Auth::user()->isAdmin())
                    <li>{{ HTML::link('users/dashboard', 'Panel usuarios') }}
                        <ul>
                            <li>{{ HTML::link('users/register', 'Registrar') }}</li>
                        </ul>
                    </li>
                    @endif

                    <li>{{ HTML::linkAction('PacientesController@index', 'Pacientes') }}
                    <ul>
                        <li>{{ HTML::linkAction('PacientesController@crear', 'Crear pacientes') }}</li>
                        <li>{{ HTML::linkAction('PacientesController@show', 'Buscar pacientes') }}</li>
                    </ul>
                    </li>
                    <li>{{ HTML::linkAction('TratamientosController@index', 'Tratamientos') }}
                        <ul>
                            <li>{{ HTML::linkAction('TratamientosController@create', 'Crear tratamientos') }}</li>
                            <li>{{ HTML::linkAction('GruposController@index', 'Grupos de tratamientos') }}</li>
                            <li>{{ HTML::linkAction('GruposController@create', 'Crear grupo de tratamientos') }}</li>
                        </ul>
                    </li>
                    <li>{{ HTML::link('#', 'Otros datos') }}
                        <ul>
                            <li>{{ HTML::linkAction('CompaniasController@index', 'Compañías') }}</li>
                            <li>{{ HTML::link('profesional', 'Profesionales') }}</li>
                            <li>{{ HTML::link('especialidad', 'Especialidades') }}</li>
                        </ul>
                    </li>
                    <li>{{ HTML::link('#', 'Agenda') }}
                        <ul>
                            <li>{{ HTML::link('turno', 'Turnos') }}</li>
                            <li>{{ HTML::link('guardia', 'Guardias') }}</li>
                            @if(Auth::user()->isAdmin())
                            <li>{{ HTML::link('turno/create', 'Crear turnos') }}</li>
                            <li>{{ HTML::link('guardia/create', 'Crear guardias') }}</li>
                            @endif
                        </ul>
                    </li>

                  </ul>
			 </div>

			         @else
                     <div id="menu">
                     <ul class="nav"><li>{{ HTML::link('users/login', 'Login') }}</li></ul>
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
