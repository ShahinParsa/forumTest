<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function addComment(Request $request, Topic $topic)
    {
        //
        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;
        $topic->comments()->save($comment);

        return back()->withMessage('Your comment is posted!');
    }

    public function replyComment(Request $request, Comment $comment)
    {
        //
        $this->validate($request, [
            'body' => 'required'
        ]);

        $reply = new Comment();
        $reply->body = $request->body;
        $reply->user_id = auth()->user()->id;

        $comment->comments()->save($reply);

        return back()->withMessage('Your reply is posted!');
    }


    public function update(Request $request, Comment $comment)
    {
        //
        if($comment->user_id !== auth()->user()->id && auth()->user()->user_role !== 'admin')
            abort(401);

        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment->update($request->all());

        return back()->withMessage('Comment is updated!');
    }


    public function destroy(Comment $comment)
    {
        //

        if($comment->user_id !== auth()->user()->id)
            abort(401);

        $comment->delete();

        return back()->withMessage('Comment is deleted!');
    }
}
