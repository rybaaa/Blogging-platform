<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Throwable;

class DeactivateSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactivate:subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate the profiles of users whose subscriptions have not been renewed';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $activeSubscribersLastMonth = User::whereHas('subscriptions', function (Builder $query) {
            $query->whereDate('end_date', '<=', now())
                ->where('invoice_pay', false)
                ->where('is_active', true);
        })->get();
        foreach ($activeSubscribersLastMonth as $userWithLastSubscription) {
            try {
                $userWithLastSubscription->is_subscriber = false;

                $lastSubscription = $userWithLastSubscription->subscriptions()->where('is_active', 1)->first();
                $lastSubscription->is_active = false;
                $lastSubscription->save();
                $userWithLastSubscription->save();
            } catch (Throwable $e) {
                $this->error($e->getMessage());
            }
        }

        $this->info('The operation for deactivating users profile was successfull!');
    }
}
