<?php

namespace App\Models;


use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use App\Models\ActivityLog;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'model_type',
        'model_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getModelNameAttribute()
{
    if (!$this->model_type) {
        return 'N/A';
    }

    return class_basename($this->model_type);
}
}