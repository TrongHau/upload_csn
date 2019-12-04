<?php

namespace App\Http\Controllers\Auth;

use App\Models\UserModel as User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Models\MailTokenModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'username' => 'required|string|max:50|unique:csn_users|min:4',
            'email' => 'required|string|email|max:255|unique:csn_users',
            'name' => 'required|string|min:2|max:50',
            'password' => 'required|string|min:6|max:30',
            'captcha' => 'required',
        ]);
        $validator->setAttributeNames([
            'username' => 'Tên Tài Khoản',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'captcha' => 'Mã bảo vệ'
        ]);
        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'user_lastvisit' => time(),
            'user_regdate' => time(),
            'user_active' => DEACTIVE_USER,
            'password' => bcrypt($data['password']),
        ]);
        $user->user_id = $user->id;
        $user->save();
        $token = MailTokenModel::create([
            'email' => $data['email'],
            'token' => Str::random(60),
            'created_at' => date('Y-m-d H:m', time())
        ]);
        $data = [
            'user' => $user,
            'token' => $token,
        ];
        Mail::send('emails.register', $data, function($message) use ($user)
        {
            $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $message->to($user->email, $user->name)->subject('Xác nhận thông tin đăng ký tài khoản Chia Sẻ Nhạc');
        });
        return $user;
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        return response()->json(['success' => true], 200);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
