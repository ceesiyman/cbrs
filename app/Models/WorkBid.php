<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkBid extends Model
{
    protected $table = 'work_bids';

    protected $fillable = [
        'work_id',
        'user_id',
        'bid_amount',
        'bid_status'
    ];

    protected $casts = [
        'bid_amount' => 'decimal:2',
        'bid_date' => 'datetime'
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 