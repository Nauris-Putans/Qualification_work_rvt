<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCommentCreateRequest;
use App\Mailers\AppMailer;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Posts comment
     *
     * @param UserCommentCreateRequest $request
     * @param AppMailer $mailer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postComment(UserCommentCreateRequest $request, AppMailer $mailer)
    {
        // Data from $request variable
        $data = [
            'ticket_id' => $request->input('ticket_id'),
            'user_id' => Auth::user()->id,
            'comment' => $request->input('comment')
        ];

        // Creates comment with $data
        $comment = Comment::create($data);

        // Finds ticket by $comment->ticket->id
        $ticket = Ticket::where('id', $comment->ticket->id)->firstOrFail();

        // Changes tickets action
        $ticket->action = "Un-Answered";

        // Sends mail if the user commenting is not the ticket owner and changes ticket action
        if ($comment->ticket->user->id !== Auth::user()->id)
        {
            $ticket->action = "Answered";

            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }

        // Saves changes
        $ticket->save();

        return redirect()->back();
    }
}
