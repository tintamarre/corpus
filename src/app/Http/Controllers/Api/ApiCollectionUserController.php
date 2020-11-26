<?php

namespace App\Http\Controllers\Api;

use App\Events\UserAddedToCollectionEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttachUser;
use App\Models\Collection;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiCollectionUserController extends Controller
{
    public function __construct()
    {
    }

    public function detach(Collection $collection, User $user, Request $request)
    {
        if (Gate::allows('detach-user', $collection)) {
            $collection->users()->detach($user->id);

            if ($request->ajax() || $request->wantsJson()) {
                return response(null, Response::HTTP_OK);
            } else {
                //  need api_token if regular form
                return redirect()->route('portfolio');
            }
        }
    }

    public function store(Collection $collection, AttachUser $request)
    {
        $user = User::whereEmail($request->email)->firstOrFail();

        if (!in_array($collection->id, $user->collections()->pluck('collections.id')->toArray())) {
            $collection->users()->syncWithoutDetaching([$user->id => ['role' => 'member']]);

            event(new UserAddedToCollectionEvent($user, $collection));
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response(null, Response::HTTP_OK);
        } else {
            //  need api_token if regular form
            return redirect()->back();
        }
    }

    public function update(Collection $collection, User $user, Request $request)
    {
        if (Gate::allows('change-role', $collection)) {
            $collection->users()
      ->updateExistingPivot(
          $request->input('id'),
          [
          'role' => $request->input('role'),
        ]
      );

            return response(null, Response::HTTP_OK);
        }
    }
}
