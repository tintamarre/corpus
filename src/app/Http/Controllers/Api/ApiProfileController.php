<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfile;
use App\Http\Resources\ProfileResource;
use Auth;
use Illuminate\Http\Response;

class ApiProfileController extends Controller
{
    public function __construct()
    {
    }

    public function profile()
    {
        return new ProfileResource(Auth::user());
    }

    public function update(UpdateProfile $request)
    {
        $user = Auth::user();

        $user->fill($request->input())->save();

        return response($user, Response::HTTP_OK);
    }
}
