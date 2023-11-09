<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Rules\AllowedHtmlTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text' => ['required', 'string', new AllowedHtmlTags],
            'file' => 'mimes:jpeg,jpg,png,gif,txt',
        ]);

        $file = $request->file('file');

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
       // Перевірка на формат
       $formats = ['jpeg', 'jpg', 'png', 'gif','txt'];
       $fileFormat = $file->getClientOriginalExtension();

       if (!in_array($fileFormat, $formats)) {
           return response()->json(['error' => 'Invalid file format'], 422);
       }

        if ($validator->fails()) {
            // Handle validation failure
            return response(['error' => $validator->errors()], 422);
        }

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'text'=>$request->text,
            'parent_comment_id'=>$request->parent_comment_id,
        ]);

        $path = 'storage/comment_file/' . $comment->id . '/' . time() . '.' . $fileFormat;

        Storage::put($path, $file);

        $comment->update(['file' => $path]);

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


        $query = Comment::with(['user', 'parentComment', 'childComments.user'])
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

        $comment = Comment::with(['user', 'parentComment', 'childComments.user'])->find($commentId);

        if ($comment) {
            return response()->json(['comment' => $comment], 200);
        } else {
            return response()->json(['error' => 'Comment not found'], 404);
        }
    }
}

?>
