<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user)
    {
        $user->following()->attach(Auth::id());
        return redirect('/mypage/' . $user->id);
    }
    
    public function destroy(User $user)
    {
        $user->following()->detach(Auth::id());
        return redirect('/mypage/' . $user->id);
    }
    
    public function FollowUser(User $user, Request $request)
    {
        //dd($user->followed()->orderBy('pivot_following_user_id', 'DESC')->get());
        return view('mypage/follow')->with([ 'user' => $user->followed()->orderBy('pivot_following_user_id', 'DESC')->get(), 'url' => url()->previous()]);
    }
    
    public function FollowingUser(User $user)
    {
        return view('mypage/following')->with([ 'user' => $user->following()->orderBy('pivot_followed_user_id', 'DESC')->get(), 'url' => url()->previous()]);
    }
}
