<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $guarded = ['id'];

    public function post(){
        return $this->hasOne(Post::class);
    }
}
