<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiToken extends Model
{
    use HasFactory;

    protected $fillable = ['api_token', 'api_token_expires', 'user_id'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

