<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrialEndNotification;

use Illuminate\Support\Facades\Log;


class TrialCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trial:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "check memeber's expiry date";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            Log::info('01##');
            $users = User::whereNotNull('user_trial')->get();
            $today = Carbon::today();
            // Log::info($users);  //모델 참조하는지 확인 Log

            foreach ($users as $user) {
                $trialEnd = Carbon::parse($user->user_trial);
                // 뭐가 true값 false값 나오는지
                // Log::info($user->name. '\'s trial : ' . var_export($trialEnd->isSameDay($today), true));

                if ($trialEnd->isSameDay($today)) {
                    Log::info('start mail send...');

                    Mail::to($user->email)->send(new TrialEndNotification($user->name));
                    // Mail::to($user->email)->queue(new TrialEndNotification($user->name));
                    $this->info('Trial ended email sent to: ' . $user->email);
                    Log::info('sent!!');
                }
            }
        } catch (\Exception $e) {
            Log::error('Error!!!: {message}' ,['message'=>$e->getMessage()]);
            $this->error($e->getMessage());
        }
    }
}
