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
}

?>
