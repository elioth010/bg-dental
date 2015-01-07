<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BG-Dental</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
        {{ HTML::style('css/main.css') }}
    </head>

    <body>
        <div id="wrapper">
            <header>
                <div class="logo"></div></br><h2>Versión de PRUEBAS.</br></h2>
            </header>

            @if(Auth::check())

            <div id="menu">

                <ul class="nav">  
                    <li>{{ HTML::link('users/register', 'Registrar') }}</li>

                    {{-- <li>{{ HTML::link('pacientes', 'Pacientes') }}
                    <ul>
                        <li>{{ HTML::link('pacientes/crear', 'Crear pacientes') }}</li>
                        <li>{{ HTML::link('pacientes/buscar', 'Buscar pacientes') }}</li>
                    </ul> --}}
                    </li>
                    <li>{{ HTML::link('tratamientos', 'Tratamientos') }}
                        <ul>
                            {{-- <li>{{ HTML::link('tratamientos/crear', 'Crear tratamientos') }}</li> --}}
                            <li>{{ HTML::link('tratamientos/grupos', 'Grupos de tratamientos') }}</li>
                            {{-- <li>{{ HTML::link('tratamientos/creargrupo', ' Crear grupo de tratamientos') }}</li> --}}
                        </ul>
                    </li>            
<<<<<<< HEAD
                    <li>Otros datos:
                        <ul>
                            <li>{{ HTML::link('tratamientos/companias', 'Compañías') }}</li>
                            <li>{{ HTML::link('profesional', 'Profesionales') }}</li>
                            <li>{{ HTML::link('especialidad', 'Especialidades') }}</li>
                        </ul>
                    </li>
                    
                     @else
                     ¡No estás dentro!
                    <li>{{ HTML::link('users/login', 'Login') }}</li>
=======
                    <li>{{ HTML::link('tratamientos/companias', 'Compañías') }}
                    </li>
                    <li>{{ HTML::link('users/logout', 'Salir') }}</li>

                    @else

                    <li>{{ HTML::link('users/login', 'Entrar') }}</li>
>>>>>>> abbdca322cf0518c237def8bd7af15877493076b
                    @endif
                </ul> 

            </div> 

            <div class="container">
                @if(Session::has('message'))
                <p class="alert">{{ Session::get('message') }}</p>
                @endif

                @yield('contenido')



            </div>

            <footer>   
                Creado por Bitgeenius.com
            </footer>
        </div> 
    </body>
</html>