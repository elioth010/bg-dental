<?php
 
class UsersController extends BaseController {
    
    
    public function __construct() {
    $this->beforeFilter('csrf', array('on'=>'post'));
    $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }

    protected $layout = "layouts.main";
    
    public function getRegister() {
    $this->layout->content = View::make('users.register');
    }
    
    public function postCreate() {
     
     $validator = Validator::make(Input::all(), User::$rules);
 
    if ($validator->passes()) {
        // validation has passed, save user in DB
    $user = new User;
    $user->firstname = Input::get('firstname');
    $user->lastname = Input::get('lastname');
    $user->email = Input::get('email');
    $user->password = Hash::make(Input::get('password'));
    $user->save();

    return Redirect::to('users/login')->with('message', 'Thanks for registering!');
    } else {
        // validation has failed, display error messages
        return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
    }

    }

    public function getLogin() {
    return View::make('users.login');
    }

    public function postSignin() {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
            Session::put('user_id', Auth::id());
            return Redirect::to('tratamientos')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('users/login')
                ->with('message', 'Error en nombre de usuario y/o contraseña')
                ->withInput();
        }
    }

    public function getDashboard() {
      $this->layout->content = View::make('users.dashboard');
}

public function getLogout() {
     Auth::logout();
    return Redirect::to('users/login')->with('message', 'Your are now logged out!');
}
}
?>