<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
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

    public static function get_all_admin_list()
    {
        return DB::table('users')
            ->join('role_users', 'users.id','=','role_users.user_id')
            ->join('roles', 'roles.id','=','role_users.role_id')
            ->select('*')
            ->get();
    }

    public static function get_user_role($id)
    {
        return DB::table('users')
            ->join('role_users', 'users.id','=','role_users.user_id')
            ->join('roles', 'roles.id','=','role_users.role_id')
            ->select('*')
            ->where('users.id',$id)
            ->first();
    }
}
