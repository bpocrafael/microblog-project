<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use App\Models\UsersPost;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function store(UserPostRequest $request)
    {
        $validatedData = $request->validated();
        $user = auth()->user();

        $userPost =  $user->posts()->create([
            'content' => $validatedData['content'],
        ]);
        
        return view('post.display');
    }
}
