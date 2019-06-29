<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uuidable {
    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
    
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    
}