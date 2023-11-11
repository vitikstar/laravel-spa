<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'text',
        'file',
        'parent_comment_id',
        'date_create',
        'date_update',
    ];

    public function getComments($args)
    {
        // Set default values for offset and limit if not provided
        $offset = $args['offset'] ?? 0;
        $limit = $args['limit'] ?? 10; // Set your desired default limit

        // Use the Comment model to build the query
        $query = Comment::query()->offset($offset)->limit($limit);

        // Execute the query and fetch the comments
        $comments = $query->get();

        return $comments;
    }

    public function comments($rootValue, array $args) {
        return $this->getComments($args);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    public function childComments()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }
}
