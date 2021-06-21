<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['stories.user', 'stories.likes','stories.tags']);

        $stories = $user->stories->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'stories' => $stories,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load(['likes.user', 'likes.likes', 'likes.tags']);

        $stories = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'stories' => $stories,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('followings.funs');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }
    
    public function funs(string $name)
    {
        $user = User::where('name', $name)->first()
        ->load('funs.funs');

        $funs = $user->funs->sortByDesc('created_at');

        return view('users.funs', [
            'user' => $user,
            'funs' => $funs,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }
    
    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }
}
