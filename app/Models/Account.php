<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'accounts';

    protected $fillable = [
        'user_id',
        'account_type_id',
        'status',
        'available_balance'
    ];

    public function account_type()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
