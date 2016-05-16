<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table="modules";

    public static function get_permission_by_module($id)
    {
        $data = array();
        $row = UserAccess::select('access_data','user_id')->where('module_id',$id)->get();

        if (count($row) >= 1) {
            foreach($row as $param) {
                $data[$param->user_id] = json_decode($param->access_data, true);
            }
            return $data;

        } else {
            return false;
        }
    }
}
