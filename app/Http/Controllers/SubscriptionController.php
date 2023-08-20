<?php

namespace App\Http\Controllers;
use App\Http\Middleware\isEmployer;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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

    public function initPay(Request $request){
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

        Stripe::setApiKey(config('services.stripe.secret'));
        //payment 실행
        try {
            $selectPlan = null;
            if($request->is('pay/weekly')) {                
                $selectPlan = $plans['weekly'];
                $billingEnds = now()->addWeek()->startOfDay()->toDateString();                
            }elseif($request->is('pay/monthly')) {
                $selectPlan = $plans['monthly'];
                $billingEnds = now()->addMonth()->startOfDay()->toDateString();
            }elseif($request->is('pay/anually')) {
                $selectPlan = $plans['anually'];
                $billingEnds = now()->addYear()->startOfDay()->toDateString();
            }
            
            
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

    public function paymentSuccess(Request $request){
        //결제 성공시 DB 업데이트
        $plan = $request -> plan;
        $billingEnds = $request->billing_ends;
        User::where('id', auth()->user()->id)->update([
            'plan'=> $plan,
            'billing_ends' => $billingEnds,
            'status'=>'paid'
        ]);

        return redirect()->route('dashboard.index')->with('successMessage','The payment has been approved.');
    }

    public function cancel(Request $request){
        //결제 실패시   

        return redirect()->route('dashboard.index')->with('errorMessage','Your payment has failed.');

    }
}
