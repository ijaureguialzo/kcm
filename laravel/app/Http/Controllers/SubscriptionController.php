<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class SubscriptionController extends Controller
{
    public function subscribe(Repository $repository, User $user)
    {
        $rol = Role::where('name', 'subscriber')->firstOrFail();
        $user->subscribed_repositories()->syncWithoutDetaching([$repository->id => ['role_id' => $rol->id]]);

        return back();
    }

    public function unsubscribe(Repository $repository, User $user)
    {
        $user->subscribed_repositories()->detach($repository->id);

        return back();
    }

    public function index()
    {
        $user = Auth::user();
        $repositories = $user->subscribed_repositories()->get();

        return view('subscriptions.index', compact(['repositories', 'user']));
    }
}
