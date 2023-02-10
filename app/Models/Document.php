<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $casts = ['created_at' => 'date:d M, Y'];

    protected $fillable = [
        'user_id',
        'display_name',
        'original_name',
        'doctype',
        'docsize',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
