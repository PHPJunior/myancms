<?php

namespace App\Models;

use Cartalyst\Tags\TaggableInterface;
use Cartalyst\Tags\TaggableTrait;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model implements TaggableInterface
{
    use TaggableTrait;

    protected $table = 'blogs';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
