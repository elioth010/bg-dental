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
 </header>

                    @if(Auth::check())
                    
 <div id="menu">

                <ul class="nav">
                    <li>{{ HTML::link('users/register', 'Registrar') }}</li>
                    @if(Auth::user()->isAdmin())
                    <li>{{ HTML::link('users/dashboard', 'Panel usuarios') }}</li>
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
                            <li>{{ HTML::linkAction('ProfesionalController', 'Profesionales') }}</li>
                            <li>{{ HTML::linkAction('EspecialidadController', 'Especialidades') }}</li>
                        </ul>
                    </li>
                    <li>{{ HTML::link('users/logout', 'Salir') }}</li>

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
