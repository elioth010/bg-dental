<!DOCTYPE html>
<html lang="en">

  <head>
@include('includes.head')
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

                    <li>{{ HTML::link('pacientes', 'Pacientes') }}
                    <ul>
                        <li>{{ HTML::link('pacientes/crear', 'Crear pacientes') }}</li>
                        <li>{{ HTML::link('pacientes/buscar', 'Buscar pacientes') }}</li>
                    </ul>
                    </li>
                    <li>{{ HTML::link('tratamientos', 'Tratamientos') }}
                        <ul>
                            <li>{{ HTML::link('tratamientos/crear', 'Crear tratamientos') }}</li>
                            <li>{{ HTML::link('tratamientos/grupos', 'Grupos de tratamientos') }}</li>
                            <li>{{ HTML::link('tratamientos/creargrupo', ' Crear grupo de tratamientos') }}</li>
                        </ul>
                    </li>
                    <li>{{ HTML::link('#', 'Otros datos') }}
                        <ul>
                            <li>{{ HTML::link('tratamientos/companias', 'Compañías') }}</li>
                            <li>{{ HTML::link('profesional', 'Profesionales') }}</li>
                            <li>{{ HTML::link('especialidad', 'Especialidades') }}</li>
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
