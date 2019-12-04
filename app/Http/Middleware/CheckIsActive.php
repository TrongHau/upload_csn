<?php

namespace App\Http\Middleware;

use Closure;
use App\Library\Helpers;
use Jenssegers\Agent\Agent;

class CheckIsActive
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
        $isActive = $request->user()->user_active;
        if($isActive == ACTIVE_USER){
            return $next($request);
        }elseif ($isActive == BANNED_USER) {
            $messageVerify = 'Tài khoản của bạn đang bị khóa, không thể thực hiện thao tác này.';
        }else{
            $messageVerify = 'Tài khoản của bạn chưa được xác nhận bằng email để thực hiện thao tác này.';
        }
        if($request->ajax()) {
            if($request->format() == 'html') {
                return response()->make($messageVerify, 403);
            }
            Helpers::ajaxResult(false, $messageVerify, null);
        }
        $Agent = new Agent();
        $view = 'web.';
        if ($Agent->isMobile()) {
            $view = 'mobile.';
        }
        if($request->method() == 'GET') {
            return response()->view($view.'errors.403', ['message'=> $messageVerify], 403);
        }else{
            if($request->format() == 'html') {
                return response()->make($messageVerify, 403);
            }
            Helpers::ajaxResult(false, $messageVerify, null);
        }
    }
}
