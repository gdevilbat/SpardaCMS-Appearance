<?php

namespace Gdevilbat\SpardaCMS\Modules\Appearance\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use  Gdevilbat\SpardaCMS\Modules\Appearance\Http\Controllers\MenuController;

class MenuGenerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $menu = new MenuController;

        $navbars = json_decode(json_encode($menu->getNavbars()));
        $page_navbars = json_decode(json_encode($menu->getPageNavbar()));

        \View::share(
                [
                'navbars' => $navbars,
                'page_navbars' => $page_navbars,
            ]
        );

        return $next($request);
    }
}
