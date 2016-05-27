<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menu';

    public static function nestedMenu($type)
    {
        return DB::table('menu')->where('parent_id',0)->where('menu_type',$type)->orderBy('ordering','asc')->get();
    }

    public static function getChildMenu($id = 1)
    {
        return DB::table('menu')->where('parent_id',$id)->orderBy('ordering','asc')->get();
    }

    public static function getMenu($type)
    {
        return DB::table('menu')->where('parent_id',0)->where('active',1)->where('menu_type',$type)->orderBy('ordering','asc')->get();
    }

    public static function getChild($id = 1)
    {
        return DB::table('menu')->where('parent_id',$id)->where('active',1)->orderBy('ordering','asc')->get();
    }
}
