<?php

class UsersController extends BaseController {

    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    protected $layout = "layouts.main";

    public function getRegister() {
        $usergroups = Usergroups::lists('nombre', 'id');
        $sedes = Sedes::get();
        $this->layout->content = View::make('users.register')->with(array('usergroups' => $usergroups, 'sedes' => $sedes));
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
            $user->group_id = Input::get('group_id');
            $sedes = Sedes::count();

            $user->save();
            $i = 1;
            while ($i <= $sedes) {
                if (Input::has('sede-' . $i)) {
                    $sede_usuario = Input::get('sede-' . $i);
                    $user->sedes()->attach($sede_usuario);
                }
                $i++;
            }
            //return Redirect::to('users/dashboard')->with('message', '¡Usuario registrado!');
        } else {
            // validation has failed, display error messages
            return Redirect::to('users/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }

    public function getLogin() {
        return View::make('users.login');
    }

    public function postSignin() {
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
            Session::put('user_id', Auth::id());
            return Redirect::to('tratamientos'); //->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('users/login')
                            ->with('message', 'Error en nombre de usuario y/o contraseña')
                            ->withInput();
        }
    }

    public function getDashboard() {
        $users = User::get();
        $usergroups = Usergroups::lists('nombre', 'id');
        $this->layout->content = View::make('users.dashboard')->with('users', $users)->with('usergroups', $usergroups);
    }

    public function getEdit($id) {
        $user = User::leftJoin('usergroups','users.group_id','=','usergroups.id')->find($id);
        
        return View::make('users.editar')->with('user',$user);
        
    }
    
   public function putUpdate($id)
	{
		$user = User::find($id);
                var_dump(Input::all());
//                $user->update(Input::all());
                //return Redirect::to('users/dashboard')->with('message', 'Usuario modificado con éxito.');
	}
    public function getLogout() {
        Auth::logout();
        return Redirect::to('users/login'); //->with('message', 'Your are now logged out!');
    }

}

?>