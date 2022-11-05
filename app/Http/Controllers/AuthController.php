<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\StudentClass;
use App\Subject;
use App\Teacher;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse; 
use Twilio\Rest\Client;
	
class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
		$validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => ['required','email','unique:users'],
			'phone_no' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10','unique:users'],
            'password' => 'required|string|confirmed'
        ]);
		
		if ($validator->fails()) {
        $message = $validator->errors()->first();
        $errors=$validator->errors();

        $response = array(
            'status_code' => 422,
            'message' => $errors
        );

        return new JsonResponse($response, 422);
    }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
			'phone_no' => $request->phone_no,
            'password' => bcrypt($request->password)
        ]);
        if($user->save())
		{
			$response = array(
            'status_code' => 201,
            'message' => 'Successfully created user!'
			);
			return new JsonResponse($response, 201);
		}else{
			$response = array(
            'status_code' => 500,
            'message' => 'Something Went Wrong'
			);
			return new JsonResponse($response, 500);
		}
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
		$login = request()->input('username');

		 if(is_numeric($login)){
			$field = 'phone_no';
		} elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
			$field = 'email';
		} else {
			$field = 'username';
		}  
		
		$validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

		
		if ($validator->fails()) {
			$message = $validator->errors()->first();
			$errors=$validator->errors();
			$code=422;

			$response = array(
				'status_code' => $code,
				'message' => $errors,
			);

			return new JsonResponse($response, $code);
		}
		$credentials = [
        $field => $request['username'],
        'password' => $request['password'],
		];
        //$credentials = request([$field, 'password']);
        if(!Auth::attempt($credentials)){
			$response = array(
				'status_code' => 401,
				'message' => 'Unauthorized'
			);
			return new JsonResponse($response, 401);
		}
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
		$data['access_token'] = $tokenResult->accessToken;
		$data['token_type'] = 'Bearer';
		$data['expires_at'] = Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString();
		$data['user_info'] = Auth::user();
		$data['classes'] = StudentClass::all()->toArray();
		$data['subjects'] = Subject::all()->toArray();
		$response = array(
				'status_code' => 200,
				'message' => 'success',
				'data' => $data
			);
		
       return new JsonResponse($response, 200);
    }
    /**
     * Login user  using otp and create token && resend OTP
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function loginWithOtp(Request $request)
    {
		
		
		$validator = Validator::make($request->all(), [
            'phone_no' => 'required'
        ]);

		
		if ($validator->fails()) {
			$message = $validator->errors()->first();
			$errors=$validator->errors();
			$code=422;

			$response = array(
				'status_code' => $code,
				'message' => $errors,
			);

			return new JsonResponse($response, $code);
		}
		 
		 $user = User::where('phone_no',$request->phone_no)->first();
		if($user){
			$otp = rand(0,9999);
			$this->sendMessage("Pelase do not share with anyone $otp","+91".$request->phone_no);
			$user->otp = $otp;
			$user->save();	
		}else{
			
		$newuser = new User([
			'phone_no' => $request->phone_no,
            'otp' => $otp
        ]);
        if($newuser->save())
		{
			$response = array(
				'status_code' => 200,
				'message' => 'please insert OTP',
				'phone'=>$request->phone_no
			);
			return new JsonResponse($response, 200);
		}else{
			$response = array(
            'status_code' => 500,
            'message' => 'Something Went Wrong'
			);
			return new JsonResponse($response, 500);
		}
       
		}
		
		$response = array(
				'status_code' => 200,
				'message' => 'please insert OTP',
				'phone'=>$request->phone_no
			);
			
			 return new JsonResponse($response, 200);
         
    }
	
	
	
	public function confirmLogin(Request $request){
		
		$validator = Validator::make($request->all(), [
            'phone_no' => 'required',
            'otp' => 'required',
        ]);
 
		 if ($validator->fails()) {
			$message = $validator->errors()->first();
			$errors=$validator->errors();
			$code=422;

			$response = array(
				'status_code' => $code,
				'message' => $errors,
			);

			return new JsonResponse($response, $code);
        }
		
		$user = User::where(['phone_no'=>$request->phone_no,'otp'=>$request->otp])->first();
		 if($user){
			$user->verified = 1;
			$user->otp = null;
			$user->save();
			Auth::loginUsingId($user->id);
			$tokenResult = $user->createToken('Personal Access Token');
			$token = $tokenResult->token;
			if ($request->remember_me)
				$token->expires_at = Carbon::now()->addWeeks(1);
			$token->save();
			$data['access_token'] = $tokenResult->accessToken;
			$data['token_type'] = 'Bearer';
			$data['expires_at'] = Carbon::parse(
					$tokenResult->token->expires_at
				)->toDateTimeString();
			$data['user_info'] = Auth::user();
			$data['classes'] = StudentClass::all()->toArray();
			$data['subjects'] = Subject::all()->toArray();
			$response = array(
					'status_code' => 200,
					'message' => 'success',
					'data' => $data
				);
			
       return new JsonResponse($response, 200);
		 }else{
			$response = array(
				'status_code' => 401,
				'message' => 'Invalid OTP'
			);
			return new JsonResponse($response, 401);
       
		 }
	}
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
		$response = array(
				'status_code' => 200,
				'message' => 'Successfully logged out'
			);
       return new JsonResponse($response, 200);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
	
	
	 private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_ACCOUNT_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_PHONE_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $account = $client->api->accounts($account_sid)->fetch();
       return $client->messages->create($recipients, ['from' => $twilio_number, 'body' => $message]);
    }
}