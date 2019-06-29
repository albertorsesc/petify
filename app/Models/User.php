<?php

namespace App\Models;

use App\Traits\Uuidable;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Uuidable;
    
    protected $fillable = ['uuid', 'first_name', 'last_name', 'user_type_id', 'email', 'phone', 'password', 'status', 'api_token'];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime', 'status' => 'boolean'];
    
    /** Relations */
    
    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
    
    /**
     * Mutators
     */
    
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    
    /**
     * Helpers
     * */
    
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public static function generateApiToken()
    {
        return Str::random(64);
    }
}
