<?php

namespace App\Http\Controllers;
use App\Http\Middleware\isEmployer;
use App\Mail\PurchaseMail;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;  // url을 생성해주는 extend
use Illuminate\Support\Facades\Mail; // 메일 보낼떄 이용

use Carbon\Carbon;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    const WEEKLY_AMOUNT = 20;
    const MONTHLY_AMOUNT = 60;
    const YEARLY_AMOUNT = 300;
    const CURRENCY = 'usd';

    public function __construct()
    {
        $this->middleware(['auth', isEmployer::class]);
    }
    public function subscribe(){
        return view('subscription.index');
    }

//payment 실행
    public function initPay(Request $request){
    // Stripe 실행
        Stripe::setApiKey(config('services.stripe.secret'));

        // 파라메터값
        $plans = [
            'weekly' => [
                'name' => 'weekly',
                'description' => 'weekly payment',
                'amount' => self::WEEKLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity' => 1,
            ],
            'monthly' => [
                'name' => 'monthly',
                'description' => 'monthly payment',
                'amount' => self::MONTHLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity' => 1,
            ],
            'anually' => [
                'name' => 'anually',
                'description' => 'anually_payment',
                'amount' => self::YEARLY_AMOUNT,
                'currency' => self::CURRENCY,
                'quantity' => 1,
            ],
        ];

        


    // 시험기간, 맴버십기간, 현재 중 가장 최신 기간을 latestTime에 넣기
        $userTrial = Carbon::parse($request->user()->user_trial);
        $latestTime = $request->user()->billing_ends;

 
        if($latestTime === null){
            $latestTime = (now()>$userTrial)? now():$userTrial;
        
        } elseif($latestTime !== null && now()>$latestTime){
            $latestTime = now();

        } else{
            $latestTime = Carbon::parse($request->user()->billing_ends);
        }
    // latestTime에 주문한 기간별로 시간 추가
        try {
            $selectPlan = null;
            if($request->is('pay/weekly')) {                
                $selectPlan = $plans['weekly'];
                $billingEnds = $latestTime->addWeek()->startOfDay()->toDateString();                
            }elseif($request->is('pay/monthly')) {
                $selectPlan = $plans['monthly'];
                $billingEnds = $latestTime->addMonth()->startOfDay()->toDateString();
            }elseif($request->is('pay/anually')) {
                $selectPlan = $plans['anually'];
                $billingEnds = $latestTime->addYear()->startOfDay()->toDateString();
            }
            
    /*
    플랜별로 사용시간이 정해지면,
    $successURL에 결제를 성공할시의 URL을 생성하고 
    해당 URL을 $session으로 파라매터들과 함께 stripe에 보낼 파라매터값 보냄
    결제가 성공하면 자동으로 뒤의 paymentSuccess함수 실행
    */
            if($selectPlan) {
                // url을 생성해줌  (~.com/plan=montly&billing_ends=2023-10~&signiture=토큰)
                $successURL = URL::signedRoute('payment.success',[
                    'plan' => $selectPlan['name'],
                    'billing_ends' => $billingEnds
                ]);
                // dd($selectPlan);

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    //
                    //                     
                    'line_items' => [[
                        'price_data' => [
                            'currency' => $selectPlan['currency'],
                            'unit_amount' =>$selectPlan['amount']*100, //stripe는 cent 부터 계산하기에 *100
                            'product_data' => [
                                'name' => $selectPlan['name'],
                                'description' => $selectPlan['description'],
                            ],
                        ],
                        'quantity' => $selectPlan['quantity'],
                        
                    ]],          

                    'mode' => 'payment',
                    // https://stripe.com/docs/api/checkout/sessions/create
                    // https://stripe.com/docs/api/checkout/sessions/line_items
                   
                    //현재 user가 선택한 플랜을 알기위해 필요함 
                    'success_url' => $successURL,
                    'cancel_url' => route('payment.cancel')
                ]);
                // dd($session);
                return redirect($session-> url);
                
            }

        }catch(\Exception $e){
            return response()->json($e);
        }
    }

    /*
    Stripe에서 준 값을 받아 User의 DB에 업데이트
    */

    public function paymentSuccess(Request $request){
        $plan = $request -> plan;
        $billingEnds = $request->billing_ends;
        User::where('id', auth()->user()->id)->update([
            'plan'=> $plan,
            'billing_ends' => $billingEnds,
            'status'=>'paid'
        ]);

        try{
            Mail::to(auth()->user())->queue(new PurchaseMail($plan, $billingEnds));
        } catch(\Exception $e){
            return response()->json($e);
        }

        return redirect()->route('dashboard.index')->with('successMessage','The payment has been approved.');
    }

    public function cancel(Request $request){
        //결제 실패시   

        return redirect()->route('dashboard.index')->with('errorMessage','Your payment has failed.');

    }
}
