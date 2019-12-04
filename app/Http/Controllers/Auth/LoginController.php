<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider() {

        return Socialite::driver('facebook')->redirect();
    }
    protected function attemptLogin(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if(!filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'username' => $request->email,
                'password' => $request->password,

            ];
        }
        $credentials['password'] = bcrypt($request->password);
//        if(Auth::once($credentials)) {
//            $user = Auth::getUser();
//            if($user->user_active == 0 || $user->user_active == 1) {
//                return $this->guard()->attempt(
//                    $this->credentials($request), $request->has('remember')
//                );
//            }else{
//                return false;
//            }
//        }
        $user = \App\Models\UserModel::where($credentials)->first();
        if ($user) {
            $this->guard()->login($user, $request->has('remember'));
            return true;
        }
        return false;
    }
    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';
        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return response()->json(['success' => true], 200);
    }
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|min:4',
            'password' => 'required|string|min:6',
        ]);
        if(strpos($request->email, '@')) {
            $this->validate($request, [
                'email' => 'email',
            ]);
        }
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = Auth::getUser();
        $errors = [];
        if($user) {
            if($user->user_active == BANNED_USER) {
                $errors = ['email' => 'Tài Khoản của bạn đang bị khóa'];
            }
        }else{
            $errors = ['password' => 'Mật khẩu không chính xác.'];
        }
        if ($request->expectsJson()) {
            return response()->json(['errors' => $errors], 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

}
