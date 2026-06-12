<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'content',
        'user_id',
        'article_id',
        'parent_id' // Them truong parent_id de luu ket noi binh luan cha
    ];

    public $timestamps = true;

    // Moi quan he lay binh luan cha
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Moi quan he lay danh sach cac cau tra loi con
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
