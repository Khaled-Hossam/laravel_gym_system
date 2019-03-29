<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Gym;
use App\Package;
use App\GymPackagePurshase;
use DB;
use App\Http\Requests\payment\PaymentRequest;
class PaymentController extends Controller
{
   
    public function getJsonData()
    {  
        return datatables( Member::all())->toJson();  
    }
   
    public function index()
    {
        return view('buyPackages.index');
    }

   
    public function buy($member)
    {
        return view('buyPackages.paymentForm',['gyms' => Gym::all(),'packages' =>  Package::all(),'member'=>$member]);
    }

   
    public function store(Request $request)
    {
        
        \Stripe\Stripe::setApiKey("sk_test_bY46WtClVIcLxSzhVKKZ5XdM00PxpLUrag");
        $token =$request['stripeToken'];
        $package=Package::findOrFail($request->package_id);
        $gym=Gym::findOrFail($request->gym_id);
        $member=Member::findOrFail($request->member);
        
        try {
                $charge = \Stripe\Charge::create([
                    'amount' => intval($package->price),
                    'currency' => 'usd',
                    'description' => 'buy package '.$package->name. ' has '. $package->sessions_number.' with '.number_format($package->price/100,2).' for member '.$member->email ." at ".date("M,d,Y h:i:s A"),
                    'source' => $token,
                ]);
                if($charge["status"]="succeeded")
                {
                    GymPackagePurshase::create(['member_id' => $request->member,'package_id' =>$request->package_id,'gym_id'=>$request->gym_id,'bought_price'=>$package->price]);
                    DB::table('members')->where('id', $request->member)->increment('remaining_sessions', $package->sessions_number);
                    DB::table('members')->where('id', $request->member)->increment('total_sessions', $package->total_sessions);
                    return redirect()->route('payments.index');
                }
          
        }catch (CardErrorException $e) 
        {
            // save info to database for failed
            return back()->withErrors('Error! ' . $e->getMessage());
        }
        

        
       
    }

  
    

    
    
}
