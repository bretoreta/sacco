<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'actor_id',
        'type',
        'for',
        'amount',
        'comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }
}
