<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Rules\AllowedHtmlTags;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;



class CreateComment
{
    public function add($request, $file = null)
    {
        $validator = Validator::make($request, [
            'text' => ['required', 'string', new AllowedHtmlTags],
            'file' => 'mimes:jpeg,jpg,png,gif,txt',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if($file){
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
        }


        $comment = Comment::create([
            'user_id' => Auth::id(),
            'text'=>$request['text'],
            'parent_comment_id'=> (isset($request['parent_comment_id'])) ?? $request['parent_comment_id'],
        ]);

        if($file){
            $path = 'storage/comment_file/' . $comment->id . '/' . time() . '.' . $fileFormat;

            Storage::put($path, $file);

            $comment->update(['file' => $path]);
        }


        return $comment;
    }

}

?>
