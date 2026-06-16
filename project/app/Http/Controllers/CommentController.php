<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;


class CommentController extends Controller
{
    public function store (Request $request){ 
        $request->validate([
            'message' => 'required|max:1000',
        ]);

       Comment::create([
            'participant_id' => null,
            'message' => $request->message,
        ]);
        return back();
    }

    public function index(){
        $comments = Comment::latest()->get();

        return view ('comments.index', compact ('comments'));
    }
}
