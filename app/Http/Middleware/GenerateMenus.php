<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make('admin_sidebar', function ($menu) {
            // Dashboard
            $menu->add('<i class="nav-icon fa-solid fa-cubes"></i> '.__('Dashboard'), [
                'route' => 'backend.dashboard',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 1,
                    'activematches' => 'admin/dashboard*',
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Payment Reminder

            $menu->add('<i class="nav-icon fa-regular fa-sun"></i> Payment Reminder', [
                'route' => 'backend.paymentreminder',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 99,
                    'activematches' => [
                        'admin/paymentreminder*',
                    ],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                    'href' => '/admin/paymentreminder',
                ]);
                
            // Daily Rates

            $menu->add('<i class="nav-icon fa-regular fa-sun"></i> Daily Rates', [
                'route' => 'backend.dailyrates',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 99,
                    'activematches' => [
                        'admin/dailyrates*',
                    ],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                    'href' => '/admin/dailyrates',
                ]);

 

            // Settings
            $menu->add('<i class="nav-icon fas fa-cogs"></i> Settings', [
                'route' => 'backend.settings',
                'class' => 'nav-item',
            ])
                ->data([
                    'order' => 102,
                    'activematches' => 'admin/settings*',
                    'permission' => ['edit_settings'],
                ])
                ->link->attr([
                    'class' => 'nav-link',
                ]);

            // Set Active Menu
            $menu->filter(function ($item) {
                if ($item->activematches) {
                    $activematches = (is_string($item->activematches)) ? [$item->activematches] : $item->activematches;
                    foreach ($activematches as $pattern) {
                        if (request()->is($pattern)) {
                            $item->active();
                            $item->link->active();
                            if ($item->hasParent()) {
                                $item->parent()->active();
                            }
                        }
                    }
                }

                return true;
            });
        })->sortBy('order');

        return $next($request);
    }
}
