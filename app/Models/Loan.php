<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;

class Loan extends Model
{
    use HasFactory;
    use EagerLoadPivotTrait;

    protected $fillable = [
        'loan_type',
        'loan_description',
        'min_amount',
        'max_amount',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'loan_user');
    }
}
