<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;

class CancelOldPendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-old-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancels pending orders older than a specified duration.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $cutoffDate = Carbon::now()->subDays(2); // 2 days
        // $cutoffDate = Carbon::now()->subWeek();  // 1 week
        $cutoffDate = Carbon::now()->subDays(2);

        // Find pending orders that were created before the cutoff date
        $oldPendingOrders = Order::where('status', 'pending')
            ->where('created_at', '<', $cutoffDate)
            ->get();

        $canceledCount = 0;

        if ($oldPendingOrders->count() > 0) {
            $this->info("Found {$oldPendingOrders->count()} old pending orders to cancel.");

            foreach ($oldPendingOrders as $order) {
                // Update the order status to 'canceled'
                $order->status = 'canceled';
                $order->save(); // Or use $order->update(['status' => 'canceled']);

                // You might want to add additional logic here, such as:
                // - Logging the cancellation
                // - Notifying the user (e.g., via email)
                // - Reverting stock levels if applicable (depends on your inventory system)

                $canceledCount++;
            }

            $this->info("Successfully canceled {$canceledCount} old pending orders.");
        } else {
            $this->info('No old pending orders found to cancel.');
        }

        return 0; // Indicate successful execution
    }
}
