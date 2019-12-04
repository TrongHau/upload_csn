<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 3:33 PM
 */

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Helpers;
use App\Repositories\User\UserEloquentRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\QrCodeToken\QrCodeTokenRepository;
use App\Models\UserModel;
use App\Models\UserModel as User;
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Models\MailTokenModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Http\JsonResponse;
use App\Repositories\ArtistFavourite\ArtistFavouriteRepository;
use App\Repositories\Session\SessionEloquentRepository;
use Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepository;
    protected $playlistRepository;
    protected $artistFavouriteRepository;
    protected $qrCodeTokenRepository;
    protected $sessionEloquentRepository;

    public function __construct(UserEloquentRepository $userRepository, PlaylistEloquentRepository $playlistRepository, ArtistFavouriteRepository $artistFavouriteRepository, SessionEloquentRepository $sessionEloquentRepository, QrCodeTokenRepository $qrCodeTokenRepository)
    {
        $this->userRepository = $userRepository;
        $this->playlistRepository = $playlistRepository;
        $this->sessionEloquentRepository = $sessionEloquentRepository;
        $this->qrCodeTokenRepository = $qrCodeTokenRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $user = $this->userRepository->getUserById($id)->first();
        if(!$user)
            return new JsonResponse(['message' => 'Người dùng đang được cập nhật.', 'code' => 400, 'data' => [], 'error' => []], 400);
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['user' => Helpers::convertArrHtmlCharsDecode($user)], 'error' => []], 200);
    }
    public function store(Request $request) {
        $reqRefresh = false;
        $reqValid = [
            'name' => 'required|max:255|min:4',
            'user_birthday' => 'max:10',
            'user_interests' => 'max:250',
        ];
        $setAttr = [
            'name' => 'Tên',
            'user_birthday' => 'Ngày sinh',
            'username' => 'Tên tài khoản',
            'password' => 'Mật khẩu',
            'user_interests' => 'Thông tin',
            'repassword' => 'Nhập lại mật khẩu',
            'current_password' => 'Mật khẩu cũ'
        ];
        if(!Auth::user()->username) {
            $reqValid['password'] = 'required|max:255|min:6';
            $reqValid['username'] = 'required|max:255|min:4|max:30|alpha_dash|unique:csn_users';
            $reqValid['repassword'] = 'required|max:255|min:6|same:password';
            $reqRefresh = true;
        }else{
            if($request->input('current_password')) {
                $reqValid['current_password'] = 'required|max:255|min:6';
                $reqValid['password'] = 'required|max:255|min:6';
                $setAttr['password'] = 'Mật khẩu mới';
            }
        }
        $validator = Validator::make($request->all(), $reqValid);
        $validator->setAttributeNames($setAttr);
        if($validator->fails()) {
            Helpers::ajaxResult(false, 'Lỗi', $validator->errors()->toArray());
        }
        $update = [
            'name' => $request->input('name'),
            'user_gender' => $request->input('user_gender'),
            'user_birthday' => $request->input('user_birthday'),
            'user_phone_number' => $request->input('user_phone_number'),
            'user_interests' => $request->input('user_interests')
        ];
        if(!Auth::user()->username) {
            $update['username'] = trim(strtolower($request->input('username')));
            $update['password'] = Hash::make($request->input('password'));
        }else{
            if($request->input('password') && $request->input('current_password')) {
                if(Hash::check($request->input('current_password'), Auth::User()->password))
                {
                    $update['password'] = Hash::make($request->input('password'));
                }
                else
                {
                    Helpers::ajaxResult(false, 'Lỗi', ['current_password' => ['Xác nhận mật khẩu cũ không chính xác']]);
                }
            }
        }
        if($request->input('user_avatar')){
            $path = Helpers::file_path(Auth::user()->id, AVATAR_PATH, true);
            $fileNameAvatar = Helpers::saveBase64ImageJpg($request->input('user_avatar'), $path, Auth::user()->id);
            $update['user_avatar'] = $fileNameAvatar;
        }
        $user = UserModel::where('id', Auth::user()->id)->update($update);
        $update['refresh'] = $reqRefresh;
        Helpers::ajaxResult(true, 'Cập nhật tài khoản thành công', $update);
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url()->previous());
    }
    public function verifyEmail(Request $request, $token)
    {
        $tokenVerify = MailTokenModel::where('token', $token)->first();
        if(!$tokenVerify)
            return view('errors.text_error')->with('message', 'Mã xác nhận email của bạn không tồn tại.');
        $user = UserModel::where('email', $tokenVerify->email)->where('user_active', DEACTIVE_USER)->first();
        if(!$user)
            return view('errors.text_error')->with('message', 'Lỗi xác thực email, kiểm tra tình trạng tài khoản của bạn.');
        UserModel::find($user->id)->update([
            'user_active' => ACTIVE_USER
        ]);
        MailTokenModel::deleteToken($tokenVerify->email);
        Auth::login($user);
        return redirect('/');
    }
    public function qrCodeLogin(Request $request, $token) {
        if($token) {
            $qrToken = $this->qrCodeTokenRepository->getModel()::where('token', $token)->first();
            if($qrToken) {
                if($qrToken->time_expired < time()) {
                    return new JsonResponse(['message' => 'Đăng nhập thất bại, Qr code đã hết hạn', 'code' => 400, 'data' => [], 'error' => []], 400);
                }
                $sess = $this->sessionEloquentRepository->getModel()::where('id', $qrToken->session_id)->first();
                if($sess && $sess->user_id) {
                    $existUser = User::where('user_id', '=', $sess->user_id)->first();
                    $existUser->sid = session()->getId();
                    $qrToken->status = 'close';
                    $qrToken->save();
                    return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => Helpers::convertArrHtmlCharsDecode($existUser), 'error' => []], 200);
                }
            }

        }
        return new JsonResponse(['message' => 'Đăng nhập thất bại', 'code' => 400, 'data' => [], 'error' => []], 400);
    }
}
