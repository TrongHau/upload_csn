<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Config;
use Illuminate\Support\Facades\Auth;

class HttpsProtocol {

    public function handle($request, Closure $next)
    {
        if (!$request->secure() && App::environment() === 'beta') {
            return redirect()->secure($request->getRequestUri());
        }
//        if(strpos($request->url(), '_download') !== false) {
//            return redirect()->route('home');
//        }
//        if(in_array($request->ip(), Config::get('checkip.deny'))){
//            return redirect()->route('home');
////            exit;
////            abort(403, 'Lỗi truy cập');
//        }
        if ($request->ip() == '210.245.121.234' || $request->ip() == '14.161.21.142') {
            \Debugbar::enable();
        }
        $expUri = explode('/', $request->getRequestUri());
        if(strpos($request->getHttpHost(), 'news') !== false) {
            if($request->getRequestUri() == '/') {
                return redirect()->route('news.index.html');
            }
            if(isset($expUri[1]) && !($expUri[1] == 'tin-tuc' || $expUri[1] == 'tin-tuc.html')) {
                return redirect(env('APP_URL').$request->getRequestUri());
            }
        }
        if(isset($expUri[1]) && ($expUri[1] == 'tin-tuc' || $expUri[1] == 'tin-tuc.html')) {
            if(strpos($request->getHttpHost(), 'news') === false) {
                return redirect('//news.'.$request->getHttpHost().$request->getRequestUri());
            }
        }
//        if(isset($expUri[1]) && strpos($expUri[1], 'tim-kiem?q=') !== false) {
//            if(strpos($request->getHttpHost(), 's.') === false) {
//                return redirect('//s.'.$request->getHttpHost().$request->getRequestUri());
//            }
//        }

        return $next($request);
    }
}