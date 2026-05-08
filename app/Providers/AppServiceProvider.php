<?php

namespace App\Providers;

use App\Models\ContactInquiry;
use App\Models\Order;
use App\Support\Storefront;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Storefront::class, fn () => new Storefront());
    }

    public function boot(): void
    {
        View::composer(['layouts.app', 'pages.*', 'partials.*'], function ($view) {
            $storefront = app(Storefront::class);

            $view->with([
                'brand' => $storefront->brand(),
                'navCategories' => $storefront->categories(),
                'cartPreviewItems' => $storefront->cartItems(),
                'cartCount' => $storefront->cartCount(),
                'cartSubtotal' => $storefront->cartSubtotal(),
                'cartSubtotalFormatted' => $storefront->money($storefront->cartSubtotal()),
                'wishlistCount' => $storefront->wishlistCount(),
            ]);
        });

        View::composer(['admin.layouts.app', 'admin.pages.*', 'admin.partials.*'], function ($view) {
            $stats = [
                'pending_orders' => 0,
                'unread_messages' => 0,
            ];

            try {
                if (Schema::hasTable('orders')) {
                    $stats['pending_orders'] = Order::query()
                        ->where('status', 'pending')
                        ->count();
                }

                if (Schema::hasTable('contact_inquiries')) {
                    $stats['unread_messages'] = ContactInquiry::query()
                        ->where('is_read', false)
                        ->count();
                }
            } catch (Throwable) {
                // Avoid breaking view rendering when tables are not ready yet.
            }

            $view->with('adminNavStats', $stats);
        });
    }
}
