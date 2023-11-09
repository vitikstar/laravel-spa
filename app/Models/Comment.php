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
