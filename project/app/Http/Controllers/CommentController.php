<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Event;
use app\Models\Participant;


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
        return back()->with('success', 'Mensaje enviado');
    }


    public function index(){
        $comments = Comment::latest()->get();

        return view ('comments.index', compact ('comments'));
    }

    public function adminTransmission()
{
    $comments = Comment::latest()->get();

    $event = Event::where('status', 'active')->first();

    return view(
        'pages.admin.comments',
        compact('comments','event')
    );
}

}
