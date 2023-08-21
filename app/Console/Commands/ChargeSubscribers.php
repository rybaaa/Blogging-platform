<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Console\Command;
use Throwable;

class ChargeSubscribers extends Command
{

    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        parent::__construct();
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charge:subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge users how are subscribed on the blog app.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $activeSubscribers = Subscription::query()
            ->with('user')
            ->where('is_active', true)
            ->where('invoice_pay', true)
            ->whereDate('end_date', '<=', now())
            ->get();

        foreach ($activeSubscribers as $subscription) {
            try {
                $newSubscription = $this->subscriptionService->handleSubscription(
                    $subscription->user,
                    []
                );
                $newSubscription->save();
            } catch (Throwable $e) {
                $this->error($e->getMessage());
            }
        }

        $this->info('The operation was successfull!');
    }
}
