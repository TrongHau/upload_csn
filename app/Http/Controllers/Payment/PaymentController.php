<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 3:33 PM
 */

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Helpers;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\Payment\PaymentEloquentRepository;
use App\Repositories\Level\LevelEloquentRepository;
use App\Repositories\UserLevel\UserLevelEloquentRepository;
use App\Repositories\Voucher\VoucherEloquentRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\MailTokenModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepository;
    protected $paymentRepository;
    protected $levelRepository;
    protected $userLevelRepository;
    protected $voucherRepository;

    public function __construct(UserEloquentRepository $userRepository, PaymentEloquentRepository $paymentRepository, LevelEloquentRepository $levelRepository, UserLevelEloquentRepository $userLevelRepository, VoucherEloquentRepository $voucherRepository)
    {
        $this->userRepository = $userRepository;
        $this->paymentRepository = $paymentRepository;
        $this->levelRepository = $levelRepository;
        $this->userLevelRepository = $userLevelRepository;
        $this->voucherRepository = $voucherRepository;
        if(!Auth::check()) {
            return new JsonResponse(['message' => 'Bạn chưa đăng nhập để tạo thanh toán', 'code' => 400, 'data' => [], 'error' => []], 400);
        }
        if(backpack_user()->can('banned_transaction_exchange')){
            return new JsonResponse(['message' => 'Bạn không được phép giao dịch trên Chia Sẻ Nhạc', 'code' => 400, 'data' => [], 'error' => []], 400);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPaymentCenLevel(Request $request) {
        if(!$request->level_id || $request->from_request != 'CEN')
            return new JsonResponse(['message' => 'Tham số truyền vào chưa chính xác, vui lòng kiểm tra lại', 'code' => 400, 'data' => [], 'error' => []], 400);
        if(backpack_user()->can('banned_transaction_cen'))
            return new JsonResponse(['message' => 'Bạn không được phép giao dịch Cen trên Chia Sẻ Nhạc', 'code' => 400, 'data' => [], 'error' => []], 400);
        $level = $this->levelRepository->getModel()::where('level_id', $request->level_id)->where('level_status', 1)->first();
        $user = Auth::user();
        if(!$level)
            return new JsonResponse(['message' => 'Cấp độ lựa chọn không tồn tại', 'code' => 400, 'data' => [], 'error' => []], 400);
        if($level->level_cen > $user->user_money)
            return new JsonResponse(['message' => 'Cen hiện tại bạn không đủ, vui lòng kiểm tra tại tài khoản', 'code' => 400, 'data' => [], 'error' => []], 400);
        $payment = [
            'user_id' => Auth::user()->user_id,
            'level_id' => null,
            'voucher_id' => null,
            'status' => 'SUCCESS',
            'request_from' => $request->from_request,
            'cen_current_user' => Auth::user()->user_money,
            'level_id' => $level->level_id,
            'note' => '',
            'status' => 'SUCCESS',
            'level_cen' => $level->level_cen,
            'level_money' => $level->level_money,
            'time_add_expired' => $level->level_time_expried,
            'pay_cen_value' => $level->level_cen,
        ];
        $result = $this->userLevelRepository->upgradeUserLevel($user->user_id, $level);
        if(!$result['success'])
            return new JsonResponse(['message' => $result['msg'], 'code' => 400, 'data' => [], 'error' => []], 400);
        $user->user_money = $user->user_money - $level->level_cen;
        $this->paymentRepository->getModel()::create($payment);
        $user->save();
        return new JsonResponse(['message' => 'Giao dịch Cen với gói ' . $level->level_name . ' thành công', 'code' => 200, 'data' => []], 200);
    }
    public function createPaymentVoucher(Request $request) {
        if(!$request->voucher_id || $request->from_request != 'VOUCHER')
            return new JsonResponse(['message' => 'Tham số truyền vào chưa chính xác, vui lòng kiểm tra lại', 'code' => 400, 'data' => [], 'error' => []], 400);
        if(backpack_user()->can('banned_transaction_voucher'))
            return new JsonResponse(['message' => 'Bạn không được phép giao dịch Cen trên Chia Sẻ Nhạc', 'code' => 400, 'data' => [], 'error' => []], 400);
        $voucher = $this->voucherRepository->getModel()::where('voucher_id', $request->voucher_id)->where('voucher_status', 1)->with('levelEnableRow')->first();
        $user = Auth::user();
        if(!$voucher)
            return new JsonResponse(['message' => 'Voucher lựa chọn không tồn tại', 'code' => 400, 'data' => [], 'error' => []], 400);
        if($voucher->voucher_pay_cen > 0 && $voucher->voucher_pay_cen > $user->user_money)
            return new JsonResponse(['message' => 'Cen hiện tại bạn không đủ, vui lòng kiểm tra tại tài khoản', 'code' => 400, 'data' => [], 'error' => []], 400);
        $payment = [
            'user_id' => Auth::user()->user_id,
            'level_id' => null,
            'voucher_id' => null,
            'status' => 'SUCCESS',
            'request_from' => $request->from_request,
            'cen_current_user' => Auth::user()->user_money,
            'voucher_id' => $voucher->voucher_id,
            'note' => '',
        ];
        if(isset($voucher->levelEnableRow)) {
            $level = $voucher->levelEnableRow;
            $payment['level_id'] = $voucher->levelEnableRow->level_id;
            $payment['time_add_expired'] = $voucher->levelEnableRow->level_time_expried;
            $payment['level_cen'] = $voucher->levelEnableRow->level_cen;
            $payment['level_money'] = $voucher->levelEnableRow->level_money;
            $result = $this->userLevelRepository->upgradeUserLevel($user->user_id, $level);
            if($result['success'])
                return new JsonResponse(['message' => $result['msg'], 'code' => 400, 'data' => [], 'error' => []], 400);
        }
        if($voucher->voucher_pay_cen > 0) {
            $payment['pay_cen_value'] = $voucher->voucher_pay_cen;
            $user->user_money = $user->user_money - $voucher->voucher_pay_cen;
            $user->save();
        }
        if($voucher->gift_value_cen > 0) {
            $payment['cen_add'] = $voucher->gift_value_cen;
            $user->user_money = $user->user_money + $voucher->gift_value_cen;
            $user->save();
        }
        $this->paymentRepository->getModel()::create($payment);
        return new JsonResponse(['message' => 'Giao dịch ' . $voucher->voucher_name . ' thành công', 'code' => 200, 'data' => []], 200);
    }
    public function createPaymentZaloPay(Request $request) {
        if(!$request->level_id || $request->from_request != 'ZALOPAY')
            return new JsonResponse(['message' => 'Tham số truyền vào chưa chính xác, vui lòng kiểm tra lại', 'code' => 400, 'data' => [], 'error' => []], 400);

        if(backpack_user()->can('banned_payment_zalopay')){
            return new JsonResponse(['message' => 'Bạn không được phép giao dịch ZaloPay trên Chia Sẻ Nhạc', 'code' => 400, 'data' => [], 'error' => []], 400);
        }
        $level = $this->levelRepository->getModel()::where('level_id', $request->level_id)->where('level_status', 1)->first();
        $user = Auth::user();
        if(!$level)
            return new JsonResponse(['message' => 'Cấp độ lựa chọn không tồn tại', 'code' => 400, 'data' => [], 'error' => []], 400);
        $payment = [
            'user_id' => Auth::user()->user_id,
            'level_id' => null,
            'voucher_id' => null,
            'status' => 'SUCCESS',
            'request_from' => $request->from_request,
            'cen_current_user' => Auth::user()->user_money,
            'level_id' => $level->level_id,
            'note' => '',
            'status' => 'PROCESS',
            'level_cen' => $level->level_cen,
            'level_money' => $level->level_money,
            'time_add_expired' => $level->level_time_expried,
            'pay_cen_value' => $level->level_cen,
        ];
        $payResult = $this->paymentRepository->getModel()::create($payment);

        $client = new \GuzzleHttp\Client();
        $myBody['name'] = "Demo";
        $url = 'https://sandbox.zalopay.com.vn/v001/tpe/createorder';
        $option = [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'accept' => 'application/json',
                'User-Agent' => 'FlixCD 2.0',
            ],
            'form_params'=> [
                'appid' => '203',
                'apptransid' => date('ymd').$payResult->payment_id,
                'app_user' => 'FLIX',
                'amount' => 500000,
                'apptime' => strtotime('+10 minutes') * 1000,
                'embeddata' => json_encode('{"promotioninfo":"","merchantinfo":"du lieu rieng cua ung dung"}'),
                'item' => json_encode('[{"itemid":"knb","itemname":"kim nguyen bao","itemquantity":10,"itemprice":50000}]'),
            ]
        ];
        $mac = hash_hmac('sha256', implode('|', $option['form_params']), 'eC9uhWG3pEXrrIuTYouif2idoM7SeY0D');
        $option['form_params']['mac'] = $mac;
        $option['form_params']['description'] = '';
        dd($option);
        $response = $client->request('POST', $url, $option);
        dd($response->getHeaders());
        $result = json_decode($response->getBody());
        dd($result);




        return new JsonResponse(['message' => 'Giao dịch Cen với gói ' . $level->level_name . ' thành công', 'code' => 200, 'data' => []], 200);

    }
}
