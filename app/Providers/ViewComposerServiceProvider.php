<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Compose the 'frontend.header' view
        View::composer('frontend.header', function ($view) {
            $cart = Session::get('cart', []);
            $itemCount = count($cart); // Get the number of unique items (not quantity)

            // If you want the total quantity of all items:
            // $totalQuantity = 0;
            // foreach ($cart as $item) {
            //     $totalQuantity += $item['quantity'];
            // }
            // $itemCount = $totalQuantity;


            $view->with('cartItemCount', $itemCount);
        });
    }
}
