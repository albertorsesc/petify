<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            User::with('userType')
                ->orderBy('status', 'desc')
                ->orderBy('first_name')
                ->get()
        );
    }
}
