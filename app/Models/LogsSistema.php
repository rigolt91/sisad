<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LogsSistema extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'actions',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
