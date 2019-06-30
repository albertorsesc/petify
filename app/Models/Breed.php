<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    public $timestamps = false;
    
    /** Relations */
    
    public function specie()
    {
        return $this->belongsTo(Species::class);
    }
}
