<?php

namespace App\Models;

use App\User;
use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model implements TaggableInterface
{
    use TaggableTrait;

    protected $table = 'blogs';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function TagsList()
    {
        return DB::table('tags')
                    ->select('name')
                    ->get();
    }
}
