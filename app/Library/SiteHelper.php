<?php
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
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

    public static function themeOption()
    {

        $path = base_path().'/resources/views/theme/';
        $lang = scandir($path);
        $t = array();
        foreach($lang as $value) {
            if($value === '.' || $value === '..') {continue;}
            if(is_dir($path . $value))
            {
                $fp = file_get_contents($path .$value.'/info.json');
                $fp = json_decode($fp,true);
                $t[] =  $fp ;
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

    public static function getEnvContent()
    {
        if (!file_exists(base_path('.env'))) {
            if (file_exists(base_path('.env.example'))) {
                copy(base_path('.env.example'), base_path('.env'));
            } else {
                touch(base_path('.env'));
            }
        }

        return file_get_contents(base_path('.env'));
    }

    public static function saveEnvFile(Request $input)
    {
        $message = trans('messages.environment.success');

        try {
            file_put_contents(base_path('.env'), $input->get('envConfig'));
        }
        catch(Exception $e) {
            $message = trans('messages.environment.errors');
        }

        return $message;
    }

    public static function getTableList()
    {
        $db = env('DB_DATABASE');
        $t = array();
        $dbname = 'Tables_in_'.$db ;
        foreach(DB::select("SHOW TABLES FROM {$db}") as $table)
        {
            $t[$table->$dbname] = $table->$dbname;
        }
        return $t;
    }

}