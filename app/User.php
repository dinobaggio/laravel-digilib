<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles($role)
    {
        return $this->hasRole($role);
    }

    /**
    * Check one role
    * @param string $role
    */

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function getRole() {
        return $this->roles()->where('user_id', $this->id)->first();
    }

    public static function tambah_user ($data) {
        $user = self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);

        $user->roles()
        ->attach(Role::where('name', $data['role'])->first());

        return true;

    }

}
