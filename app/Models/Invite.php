<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $table = 'invites';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
