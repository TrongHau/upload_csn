<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 3:33 PM
 */

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Helpers;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\QrCodeToken\QrCodeTokenRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Models\MailTokenModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Repositories\ArtistFavourite\ArtistFavouriteRepository;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

    public function __construct(UserEloquentRepository $userRepository, PlaylistEloquentRepository $playlistRepository, ArtistFavouriteRepository $artistFavouriteRepository, QrCodeTokenRepository $qrCodeTokenRepository)
    {
        $this->userRepository = $userRepository;
        $this->playlistRepository = $playlistRepository;
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
            return view('errors.text_error')->with('message', 'Người dùng đang được cập nhật.');
        $playlist = $this->playlistRepository->getByUser($user->id);
        return view('user.index', compact('user', 'playlist'));
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
            return view('errors.text_error')->with('message', 'Mã xác nhận email của bạn không tồn tại. Có thể do tài khoản của bạn đã được kích hoạt thành công rồi.');
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
    public function qrCode(Request $request) {
        if(Auth::check() && session()->getId()) {
            $result = $this->qrCodeTokenRepository->createQrCode(session()->getId(), Auth::user()->id);
            echo QrCode::size(250)->generate($result->token);
        }
    }

}
