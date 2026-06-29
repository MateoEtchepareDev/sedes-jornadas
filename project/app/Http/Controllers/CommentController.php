<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Participant;


class CommentController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
            'message' => 'required|max:1000',
        ]);

        $participant = Participant::findOrFail($request->participant_id);

        Comment::create([
            'participant_id' => $participant->id,
            'full_name' => $participant->full_name,
            'message' => $request->message,
        ]);

        return redirect()->route('transmission');
    }


    public function index(){
        $comments = Comment::latest()->get();

        return view ('comments.index', compact ('comments'));
    }

    public function adminTransmission() {
        $comments = Comment::latest()->get();

        $event = Event::where('status', 'active')->first();

        return view(
            'pages.admin.comments',
            compact('comments','event')
        );
    }

}
