<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}



    public function create(Request $request)
    {
    	$comment = new Comment;
    	$comment->content = $request->content;
    	$comment->article_id = $request->article_id;
        $comment->user_id = auth()->id();
    	$comment->save();
    	return back();
    }

    public function destroy(Comment $comment)
    {
        if(Gate::allows('comment-delete', $comment))
        {
            $comment->delete();
            return back();
        }
        else
        {
            return back()->with('error', 'Unauthorize');
        }
    	
    }
}
