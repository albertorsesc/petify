<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

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

    public function toggleStatus(User $user)
    {
        $user->update(['status' => ! $user->status]);
    }
}
