<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Work extends Model
{
    protected $fillable = [
        'client_id',
        'constructor_id',
        'bid_by',
        'title',
        'description',
        'assigned',
        'status',
        'start_date',
        'total_cost',
        'is_hire_request',
        'hire_status',
        'budget'
    ];

    protected $casts = [
        'start_date' => 'date',
        'assigned' => 'boolean',
        'is_hire_status' => 'boolean',
        'total_cost' => 'integer',
        'budget' => 'integer'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function constructor()
    {
        return $this->belongsTo(User::class, 'constructor_id');
    }

    public function bidBy()
    {
        return $this->belongsTo(User::class, 'bid_by');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'work_skills');
    }

    public function bids()
    {
        return $this->hasMany(WorkBid::class);
    }
} 