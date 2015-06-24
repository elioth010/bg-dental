<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {


    public static $rules = array(
        'dni'=>'required|min:9|unique:users',
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
        protected $fillable = array('firstname', 'lastname', 'email', 'group_id', 'sede_id', 'dni');
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
        return $this->group_id == Usergroups::ADMIN;
    }

    public function isProfesional()
    {
        return $this->group_id == Usergroups::PROFESIONAL;
    }

    public function isHigienista()
    {
        return $this->group_id == Usergroups::HIGIENISTA;
    }

    public function isRecepcion()
    {
        return $this->group_id == Usergroups::RECEPCION;
    }

    public function isAsesor()
    {
        return $this->group_id == Usergroups::ASESOR;
    }

    public function isUser()
    {
        //User puede ver presupuestos, pacientes, tratamientos, guardias.
        return $this->group_id == Usergroups::USER;
    }

    public function isViewer()
    {
        //Viewer sólo puede ver guardias y turnos.
        return $this->group_id == Usergroups::VIEWER;
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
