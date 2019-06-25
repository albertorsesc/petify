<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Species extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'display_name'];
}
