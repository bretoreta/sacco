<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'name',
        'repayment_months',
        'interest_rate',
        'penalty_rate'
    ];
}
