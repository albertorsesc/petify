<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    public $timestamps = false;
    protected $fillable = ['specie_id', 'name'];
    
    /** Relations */
    
    public function specie()
    {
        return $this->belongsTo(Species::class);
    }
}
