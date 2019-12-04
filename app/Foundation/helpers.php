<?php
use Illuminate\Contracts\View\Factory as ViewFactory;
use Jenssegers\Agent\Agent;
use App\Models\ErrorLogModel;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Optional;
use Illuminate\Support\Collection;
use Illuminate\Support\Debug\Dumper;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HigherOrderTapProxy;

function view($view = null, $data = [], $mergeData = [])
{
    $factory = app(ViewFactory::class);
    if (func_num_args() === 0) {
        return $factory;
    }
    $Agent = new Agent();
    if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '/admin') === false) {
        if ($Agent->isMobile()) {
            // you're a mobile device
            if(file_exists(resource_path('views/mobile').'/'.str_replace('.', '/', $view).'.blade.php') === false){
                $view = 'web.'.$view;
            }else{
                $view = 'mobile.'.$view;
            }
        }else{
            $view = 'web.'.$view;
        }
    }else{

    }
//    if(strpos($view, '.errors') !== false) {
//        $error = ErrorLogModel::where('type', last(explode('.', $view)))->where('url', $_SERVER['REQUEST_URI'])->first();
//        if(!$error) {
//            ErrorLogModel::create([
//                'request' => json_encode(app('request')->route()->getAction()),
//                'type' => last(explode('.', $view)),
//                'url' => $_SERVER['REQUEST_URI'],
//                'view' => '',
//                'message' => '',
//                'user_id' => Auth::check() ? Auth::user()->id : null,
//                'parameter' => json_encode(Request()->all()),
//                'ip_address' => Helpers::getIp()
//            ]);
//        }else{
//            $error->count_request = $error->count_request + 1;
//            $error->save();
//        }
//    }
    return $factory->make($view, $data, $mergeData);
}
function bcrypt($value, $options = [])
{
    return md5($value);
//    return app('hash')->make($value, $options);
}
function data_get($target, $key, $default = null)
{
    if (is_null($key)) {
        return $target;
    }

    $key = is_array($key) ? $key : explode('.', $key);

    while (! is_null($segment = array_shift($key))) {
        if ($segment === '*') {
            if ($target instanceof Collection) {
                $target = $target->all();
            } elseif (! is_array($target)) {
                return value($default);
            }

            $result = Arr::pluck($target, $key);
            return in_array('*', $key) ? Arr::collapse($result) : $result;
        }

        if (Arr::accessible($target) && Arr::exists($target, $segment)) {
            $target = $target[$segment];
        } elseif (is_object($target) && isset($target->{$segment})) {
            $target = $target->{$segment};
        } else {
            return value($default);
        }
    }
    if(isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'PUTT') && is_string($target)) {
        $target = htmlspecialchars(trim(stripslashes($target)), ENT_QUOTES);
    }

    return $target;
}
/**
 * Escape HTML special characters in a string.
 *
 * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
 * @param  bool  $doubleEncode default laravel 5.6 is false
 * @return string
 */
function e($value, $doubleEncode = false)
{
    if ($value instanceof Htmlable) {
        return $value->toHtml();
    }
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', $doubleEncode);
}