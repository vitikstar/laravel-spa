<?php
namespace App\Http\Controllers;

use App\Events\CommentCreated;
use App\Models\Comment;
use App\Services\CreateComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class CommentController extends Controller
{

    protected $create_comment = "";

    public function __construct(){
        $this->create_comment = new CreateComment();
    }
    public function add(Request $request)
    {

        $comment = $this->create_comment->add($request->all(),$request->file('file'));

        if ($comment) {
            event(new CommentCreated($comment));
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

        // Створення ключа для кешування
        $cacheKey = 'comments:user:' . $user_id . ':offset:' . $offset . ':limit:' . $limit . ':order_by:' . $orderBy . ':order_direction:' . $orderDirection;

        // Перевірка, чи є дані в кеші
        if (Cache::has($cacheKey)) {
            // Якщо є, повернути дані з кеша
            $comments = Cache::get($cacheKey);
        } else {
            // Якщо немає, виконати запит до бази даних
            $query = Comment::with(['user', 'parentComment', 'childComments.user'])
                ->orderBy($orderBy, $orderDirection)
                ->offset($offset)
                ->limit($limit);

            $query->when($user_id !== 0, function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            });

            // Отримати коментарі
            $comments = $query->get();

            // Зберегти результат у кеш
            Cache::put($cacheKey, $comments, 60); // 60 хвилин (змініть цей час за необхідності)
        }

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
