<!DOCTYPE html>
<html lang="en">
  <head>
@include('includes.head')
  </head>
 
  <body>
 <div id="wrapper">
 <header>Versión BETA.
     <div class="logo"></div><br/><h2>Versión de PRUEBAS.<br/></h2>
 </header>
 <div class="container">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
    
        @yield('contenido')
        
        
 <div class="register">  {{--{{ HTML::link('users/register', 'Registrar un nuevo usuario...') }}--}}</div>
    
    </div>
    <footer>
    @include('includes.footer')
    </footer>
    </div>
  </body>
</html>
