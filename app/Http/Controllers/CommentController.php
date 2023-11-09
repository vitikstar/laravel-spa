<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Rules\AllowedHtmlTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => ['required', 'string', new AllowedHtmlTags],
        ]);

        if ($validator->fails()) {
            // Handle validation failure
            return response(['error' => $validator->errors()], 422);
        }

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'text'=>$request->text,
            'is_reply'=>$request->is_reply,
        ]);

        if ($comment) {
            return response(['response' => $comment], 200);
        }
    }

    public function all(Request $request)
    {
        // Отримати параметри з запиту
        $user_id = $request->input('user_id', 0);
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $orderBy = $request->input('order_by', 'created_at');
        $orderDirection = $request->input('order_direction', 'desc');


        $query = Comment::with('user')
            ->orderBy($orderBy, $orderDirection)
            ->offset($offset)
            ->limit($limit);

        $query->when($user_id !== 0, function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        });

        // Отримати коментарі
        $comments = $query->get();


        // Повернути результат
        return response()->json(['comments' => $comments], 200);
    }

    public function one(Request $request)
    {
        $commentId = $request->input('id', 0);

        $comment = Comment::with('user')->find($commentId);

        if ($comment) {
            return response()->json(['comment' => $comment], 200);
        } else {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }
}

?>
