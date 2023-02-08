<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_type_id',
        'agenda',
        'venue',
        'happening_on',
        'is_invite_only',
    ];

    protected $appends = ['created'];

    protected $casts = [
        'is_invite_only' => 'boolean',
        'happening_on' => 'date:Y-m-d'
    ];

    public function meeting_type()
    {
        return $this->belongsTo(MeetingType::class);
    }

    public function getCreatedAttribute()
    {
        return Carbon::parse($this->happening_on)->format('d M, Y');
    }
}
