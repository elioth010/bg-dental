<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('css/main.css') }}
  </head>
 
  <body>
 <div id="wrapper">
 <header>
 <div class="logo"></div>
 </header>
 <div class="container">
        @if(Session::has('message'))
            <p class="alert">{{ Session::get('message') }}</p>
        @endif
    
        @yield('contenido')
        
        
 <div class="register">  {{ HTML::link('users/register', 'Registrar un nuevo usuario...') }}</div>
    
    </div>
    <footer>Esto sera el footer</footer>
    </div>
  </body>
</html>