<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Relationship: Post belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Post m-1 category.
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'title',
        'body',
        'image',
        'category',
    ];
}
