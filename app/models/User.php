<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {



    public static $rules = array(
        'firstname'=>'required|min:2',
        'lastname'=>'required|min:2',
        'email'=>'required|email|unique:users',
        'password'=>'required|between:6,12|confirmed',
        'password_confirmation'=>'required|between:6,12'
        );
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
        protected $fillable = array('firstname', 'lastname', 'email', 'group_id', 'sede_id');
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function sedes() {
        return $this->belongsToMany('Sedes', 'sedes_users', 'user_id', 'sede_id');
    }

    public function getFullNameAttribute() {
        return $this->attributes['firstname'] . ' ' . $this->attributes['lastname'];
    }

    public function isAdmin()
    {
        //Admin puede todo.
        return $this->group_id == 1;

    }

    public function isProfesional()
    {
        //Admin puede todo.
        return $this->group_id == 4;

    }

    public function isAsesor()
    {
        //Admin puede todo.
        return $this->group_id == 5;

    }

    public function isUser()
    {
        //User puede ver presupuestos, pacientes, tratamientos, guardias.
        return $this->group_id == 2;
    }

    public function isViewer()
    {
        //Viewer sólo puede ver guardias y turnos.
        return $this->group_id == 3;
    }

    public function isMalaga()
    {
        //Viewer sólo puede ver guardias y turnos.
        return $this->sede_id == 1;
    }

    public function isMarbella()
    {
        //Viewer sólo puede ver guardias y turnos.
        return $this->sede_id == 2;
    }

    public function isAlgeciras()
    {
        //Viewer sólo puede ver guardias y turnos.
        return $this->sede_id == 3;
    }

    public function isTodas()
    {
        //Viewer sólo puede ver guardias y turnos.
        return $this->sede_id == Sedes::TODAS;
    }
}
