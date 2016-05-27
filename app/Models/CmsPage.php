<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CmsPage extends Model
{
    protected $table = 'cms_pages';

    /**
     * @param $slug
     * @return mixed
     */
    public static function getFrontPage($slug)
    {
        return DB::table('cms_pages')->where('slug',$slug)->where('status',1)->where('template','frontend')->first();
    }
}
