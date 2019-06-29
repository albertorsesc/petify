<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
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
    
    public function store(UserRequest $request)
    {
        return new UserResource(User::create($request->all()));
    }
    
    public function show(User $user)
    {
        return new UserResource($user);
    }
    
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        
        return new UserResource($user);
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        
        return response([], 204);
    }
    
}
