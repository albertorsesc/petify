<?php

namespace App\Http\Controllers\Api;

use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserTypeResource;

class UserTypeController extends Controller
{
    public function __invoke ()
    {
        return UserTypeResource::collection(UserType::orderBy('display_name')->get());
    }
}
