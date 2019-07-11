<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breed extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['specie_id', 'name', 'status'];
    protected $casts = ['status' => 'boolean'];
    protected $with = ['specie'];
    
    /** Relations */
    
    public function specie()
    {
        return $this->belongsTo(Species::class);
    }
}
