<?php

namespace Modules\PaymentReceived\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         *
         * Module Menu for Admin Backend
         *
         * *********************************************************************
         */
        \Menu::make('admin_sidebar', function ($menu) {

            // PaymentReceiveds
            $menu->add('<i class="nav-icon fa-regular fa-sun"></i> '.__('PaymentReceiveds'), [
                'route' => 'backend.paymentreceiveds.index',
                'class' => 'nav-item',
            ])
            ->data([
                'order'         => 77,
                'activematches' => ['admin/paymentreceiveds*'],
                'permission'    => ['view_paymentreceiveds'],
            ])
            ->link->attr([
                'class' => 'nav-link',
            ]);
        })->sortBy('order');

        return $next($request);
    }
}
