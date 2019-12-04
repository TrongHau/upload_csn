<?php

namespace App\Listeners;

use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Library\Helpers;
use App\Models\UserLogModel;
use Mail;
use Illuminate\Support\Facades\Auth;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle()
    {
        $user = Auth::user();
        if($user){
            if(strpos(url()->current(),"facebook") != false) {
                $typeLoggin = 'facebook';
            }elseif (strpos(url()->current(),"google") != false) {
                $typeLoggin = 'google';
            }else{
                $typeLoggin = 'csn';
            }
            $user->user_lastvisit = time();
            $user->save();
            $userLog = UserLogModel::where('user_id', $user->user_id)->where('log_date', '>=', strtotime(date('m/d/Y', time()) . ' 00:00'))->first();
            if ($userLog === null) {
                UserLogModel::create([
                    'user_id' => $user->user_id,
                    'type' => $typeLoggin,
                    'log_date' => time()
                ]);
            }
        }
    }
}
