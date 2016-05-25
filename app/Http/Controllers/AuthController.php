<?php
namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use Lukasoppermann\Httpstatus\Httpstatuscodes as Status;


class AuthController extends Controller
{
	public $repo = '';
	function __construct(UserRepository $userRepository)
	{
		$this->repo = $userRepository;
	}

    public function login(\Request $request)
    {
        $resp = $this->repo->login($request::input('email'), $request::input('password'), $request::input('remember_me'));
        if($resp)
        {
            return response()->json(['status' => 'success', 'message' => 'User logged in successfully', 'code' => Status::HTTP_OK], Status::HTTP_OK);            
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Email and password not corrected.', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);
        }    	
    }


    public function forgotPasswordReq(\Request $request)
    {
        $resp = $this->repo->forgotPasswordReq($request::input('email'));
        if($resp)
        {
            return response()->json(['status' => 'success', 'message' => 'Please check your email to reset password', 'code' => Status::HTTP_OK], Status::HTTP_OK);            
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Email doesn\' exists.', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);
        }
    }

    public function resetPassword(\Request $request)
    {
        $id = $this->repo->verifyCode($request::input('code'));

        if($id)
        {
            $resp = $this->repo->resetPassword($id, $request::input('password'));
        }
        else
        {
           return response()->json(['status' => 'error', 'message' => 'Password reset link is expired.', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);
        }

        if($resp)
        {
            return response()->json(['status' => 'success', 'message' => 'Password reset successfully. Redirecting...', 'code' => Status::HTTP_OK], Status::HTTP_OK);            
        }
        else
        {
            return response()->json(['status' => 'error', 'message' => 'Password not reset.', 'code' => Status::HTTP_NOT_FOUND], Status::HTTP_NOT_FOUND);
        }
    }
    
}
