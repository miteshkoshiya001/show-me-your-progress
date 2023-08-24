<?php

namespace App\Console\Commands;

use App\Models\MyCoupon;
use Illuminate\Console\Command;

class MarkCouponAsExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark all coupon as expired which are older then today.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $coupons = MyCoupon::where('status', 0)->whereDate('expiry_date', '<=', date('Y-m-d'))->get();
            if (!$coupons->isEmpty()) {
                foreach ($coupons as $coupon) {
                    $coupon->status = 2;
                    $coupon->save();
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
