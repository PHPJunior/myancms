<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
    protected $table="user_accesses";

    protected $fillable = ['access_data', 'user_id', 'module_id'];
}
