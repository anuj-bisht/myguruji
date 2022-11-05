<?php

namespace App\Http\Controllers;

use App\order;
use App\Orderlog;
use App\Plan;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         

         try{
          $status = 0;
          $message = "";
          $user  = Auth::user();
          // echo "<pre>";print_r($user);die;
          $validator = Validator::make($request->all(), [
            'plan_id' => 'required',                             
          ]);

          $params = [];  
          if($validator->fails()){
            $error = json_decode(json_encode($validator->errors()));
            if(isset($error->plan_id[0])){
              $message = $error->plan_id[0];
            }
            return response()->json(["status"=>$status,"message"=>$message,"data"=>json_decode("{}")]);
          }
          
          $planData = Plan::find($request->plan_id);

          if(isset($planData->id)){        
           $amount = (($request->amount) ? $planData->amount : $planData->amount)*100; 
           $receipt = 'order_'.uniqid();
           

           // Creating order over Razor pay
            $api = new Api(getenv('RAZOR_KEY'),getenv('RAZOR_SECRET'));
            $data  = $api->order->create(array('receipt' => $receipt, 'amount' => $amount, 'currency' => 'INR')); 
          echo "<pre>";print_r($data);
            if (empty($data)) {
              $data = FALSE;
            } else {
                $result = $data;   

                $payment_log = array(
                    'id'=>$result->id,
                    'entity'=>$result->entity,
                    'amount'=>$result->amount,
                    'amount_paid'=>$result->amount_paid,
                    'amount_due'=>$result->amount_due,
                    'status'=>$result->status,
                    'attempts'=>$result->attempts,
                    'created_at'=>$result->created_at,
                ); 
                if(!isset($result->receipt)){
                  return response()->json(['status'=>$status,'message'=>'Error','data'=>$result]);                                      
                }

                $order = new Order();
                $order->razor_order_id = $result->id;
                $order->amount = ($result->amount/100);
                $order->user_id = $user->id;
                $order->plan_id = $request->plan_id;

                if($order->save()){

                    $orderLog = new Orderlog();
                    $orderLog->orders_id = $order->id;
                    $orderLog->payment_log = json_encode($payment_log);
                    $orderLog->action = 'order created';
                   $rrr =  $orderLog->save();
// print_r($rrr);
                  return response()->json(['status'=>1,'message'=>'','data'=>$order]);                                                               
                }              
            }          
          }else{
            return response()->json(['status'=>$status,'message'=>'No plan exist','data'=>json_decode("{}")]);                      
          }
          

        }catch(Exception $e){
          return response()->json(['status'=>$status,'message'=>'Error','data'=>json_decode("{}")]);                    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }

    /**
     * Edit event method
     * @return success or error
     * 
     * */
    public function verifyPayment(Request $request){
      
      try{
        $status = 0;
        $message = "";
              
        $user  = Auth::user();
        
        if(!isset($user->id)){
          return response()->json(["status"=>$status,"message"=>'User does not exist',"data"=>json_decode("{}")]);
        } 
            $api = new Api(getenv('RAZOR_KEY'),getenv('RAZOR_SECRET'));

        $validator = Validator::make($request->all(), [
          'razorpay_payment_id' => 'required',          
          'razorpay_order_id'=>'required',
          'razorpay_signature'=>'required',
          'order_id'=>'required',
        ]);        

        if($validator->fails()){
          $error = json_decode(json_encode($validator->errors()));
          if(isset($error->razorpay_payment_id[0])){
            $message = $error->razorpay_payment_id[0];
          }else if(isset($error->razorpay_order_id[0])){
            $message = $error->razorpay_order_id[0];
          }else if(isset($error->razorpay_signature[0])){
            $message = $error->razorpay_signature[0];
          }
          return response()->json(["status"=>$status,"message"=>$message,"data"=>json_decode("{}")]);
        }


        $success = false;
        if (!empty($request->razorpay_payment_id)) {
        try
            {
                $attributes = array(
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                );

               $result =  $api->utility->verifyPaymentSignature($attributes);
                $success = true;
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $result =  $error = 'Razorpay Error : ' . $e->getMessage();
            }

        }

        if ($success === true)
        {
            $orderData = Order::where('id',$request->order_id)->first();
            if(isset($orderData->id)){
              $orderData->status = 'success';
              $orderData->save();
              return response()->json(['status'=>1,'message'=>'Payment Successfully','data'=>'success']);
              
            }else{
              return response()->json(['status'=>0,'message'=>'Order does not exist','data'=>json_decode("{}")]);
            }
            
            
        }
        else
        {
            $html = "<p>Your payment failed</p><p>{$error}</p>";

            return response()->json(['status'=>0,'message'=>$html,'data'=>$html]);
        }
        
                 
      }catch(Exception $e){
        return response()->json(['status'=>$status,'message'=>'Error','data'=>json_decode("{}")]);                    
      }
              
    }
}
