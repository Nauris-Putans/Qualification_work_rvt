<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCommentCreateRequest;
use App\Mailers\AppMailer;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * @param UserCommentCreateRequest $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userPostComment(UserCommentCreateRequest $request, AppMailer $mailer)
    {
        // Data from $request variable
        $data = [
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment')
        ];

        $comment = Comment::create($data);

        // send mail if the user commenting is not the ticket owner
        if($comment->ticket->user->id !== Auth::user()->id) {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }

        return redirect()->back()->with('message', "Your comment has be submitted.");
    }
}
