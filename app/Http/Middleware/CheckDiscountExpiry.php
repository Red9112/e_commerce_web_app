<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Discount;
use Carbon\Carbon;
class CheckDiscountExpiry
{


    public function handle($request, Closure $next)
    {
        $discounts = Discount::where('expired', false)->get();

        foreach ($discounts as $discount) {
            if (Carbon::now()->greaterThan($discount->end_date)) {
                $discount->setIsExpiredAttribute(true);
            }
        }
        return $next($request);
    }


}
