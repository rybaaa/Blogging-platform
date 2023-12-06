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
        'is_active',
        'start_date',
        'end_date',
        'address'
    ];

    public function deactivateSubscription(): bool
    {
        $this->is_active = false;
        $this->invoice_pay = false;
        $this->user->is_subscriber = false;
        return $this->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
