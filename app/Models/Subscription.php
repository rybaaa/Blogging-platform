<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $attributes = [
        'invoice_pay' => true,
    ];

    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'active',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
