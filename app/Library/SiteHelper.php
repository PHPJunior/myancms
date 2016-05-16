<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Created by PhpStorm.
 * User: Nyi Nyi Lwin
 * Date: 5/11/2016
 * Time: 7:57 PM
 */
class SiteHelper
{
    public static function get_user_permission($id)
    {
        $user = Sentinel::findById($id);
        return $user;
    }

    public static function langOption()
    {
        $path = base_path() . '/resources/lang/';
        $lang = scandir($path);

        $t = array();
        foreach ($lang as $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (is_dir($path . $value)) {
                $fp = file_get_contents($path . $value . '/info.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }

        }
        return $t;
    }

    public static function moduleInfo($name)
    {
        $row =  DB::table('modules')->where('module_name', $name)->first();
        return $row;
    }

    public static function checkPermission($id)
    {
        $row = DB::table('user_accesses')->where('module_id','=', $id)
            ->where('user_id','=', Session::get('admin_id'))
            ->get();

        if (count($row) >= 1) {
            $row = $row[0];
            if ($row->access_data != '') {
                $data = json_decode($row->access_data, true);
            } else {
                $data = array();
            }
            return $data;

        } else {
            return false;
        }
    }
}