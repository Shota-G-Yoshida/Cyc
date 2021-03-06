<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class MypageController extends Controller
{
    public function mypage(User $user, Request $request)
    {
        return view('mypage/mypage')->with([ 'user' => $user, 'posts' => $user->getByUser(), 'url' => url()->previous()]);
    }
    
    public function edit(User $user)
    {
        return view('mypage/edit')->with([ 'user' => $user, 'url' => url()->previous()]);
    }
    
    public function update(UserRequest $request, User $user)
    {
        $input_user = $request['user'];
        $user->fill($input_user)->save();
        return redirect('/mypage/' . $user->id);
    }
    
}
