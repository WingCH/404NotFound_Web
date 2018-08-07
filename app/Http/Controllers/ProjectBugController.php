<?php

namespace App\Http\Controllers;

use App\Bug as BugEloquent;
use App\Comment as CommentEloquent;
use App\Fire as FireEloquent;
use Auth;
use Illuminate\Http\Request;
use Mail;

class ProjectBugController extends Controller
{
    public function fireSubmit(Request $request)
    {
        // Debugbar::info($request);
        $fire             = new FireEloquent;
        $fire->project_id = $request->input('project_id');
        $fire->bug_id     = $request->input('bug_id');
        $fire->user_id    = $request->input('user_id');
        $fire->save();

        $fireCount = FireEloquent::where('bug_id', $request->input('bug_id'))->count();
        return $fireCount;
    }
    public function statusChange(Request $request)
    {
        // Debugbar::info($request);
        $bug         = BugEloquent::find($request->input('bug_id'));
        $bug->status = $request->input('status');
        $bug->save();

        Mail::send('email.test', ['bugName' => $bug->name, 'status' => $bug->status], function ($message) {
            $message->subject('404NotFound Bugs Notification');
            $message->to('g1194582@study.ouhk.edu.hk');
        });
        return $bug->status;
    }

    public function commentSubmit(Request $request)
    {
        $comment             = new CommentEloquent;
        $comment->content    = $request->input('comment');
        $comment->project_id = $request->input('projectId');
        $comment->bug_id     = $request->input('bug_Id');
        $comment->user_id    = Auth::user()->id;
        $comment->save();

        $returnData = array('id' => Auth::user()->id, 'name' => Auth::user()->name, 'content' => $request->input('comment'));

        return json_encode($returnData);

    }
}
