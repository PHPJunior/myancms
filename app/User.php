<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function blogs()
    {
        return $this->hasMany('App\Models\Blog','user_id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task','user_id');
    }

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
