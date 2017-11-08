<?php

namespace App;

use App\Traits\UserRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, UserRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function teacher()
    {
       return $this->hasOne(Teacher::class);
    }

    public function student()
    {
       return $this->hasOne(Student::class);
    }

    public function saveLesson($lesson)
    {
       return $this->teacher->lessons()->save($lesson);
    }

    public function saveEvent($event)
    {
        return $this->teacher->events()->save($event);
    }

    public function getSubjectsUniqueAttribute()
    {
        return $this->teacher->subjects->unique();
    }

    public function owns($model)
    {
        return $this->id == $model->user_id;
    }

    public function me($user)
    {
        return $this->id === $user->id;
    }
}