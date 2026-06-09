<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewhistory extends Model
{
    use HasFactory;

    protected $table = 'viewhistories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'viewtime',
        'user_id',
        'article_id'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
