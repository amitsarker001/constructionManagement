<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class SigninController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userObj = new User();
        $logginUserId = $userObj->getLoggedinUserId();
        if ($logginUserId <= 0) {
            return view('admin.signin');
        }
        return redirect()->route('dashboard');
    }

    public function signup()
    {
        $userObj = new User();
        $logginUserId = $userObj->getLoggedinUserId();
        if ($logginUserId <= 0) {
            return view('admin.signup');
        }
        return redirect()->route('dashboard');
    }

    public function registerNotification(Request $request)
    {
        $data = array(
            'pageTitle' => 'Registration Notification',
            'status' => trim($request->query('status')),
            'message' => trim($request->query('message'))
        );
        return view('registration.notification')->with($data);
    }

    public function registrationAction(Request $request)
    {
        try {
            $message = null;
            $isEmailExists = false;
            $userObj = new User();
            $userObj->checkRegistrationValidation($request);
            $userObj->user_name = trim($request->input('user_name'));
            $userObj->email = trim($request->input('email'));
            $userObj->mobile = trim($request->input('mobile'));
            $userObj->user_type_id = doubleval(trim($request->input('user_type_id')));
            $userObj->address = trim($request->input('address'));
            $userObj->password = trim($request->input('password'));
            $isEmailExists = $userObj->isColumnValueExist('email', $userObj->email);
            if (!boolval($isEmailExists)) { // if email does not exists
                $userObj->password = passwordEncrypt($userObj->password);
                $result = $userObj->save();
                if (boolval($result)) {
                    $message = 'Registration successful.';
                    return redirect()->route('registerNotification', ['status' => $result, 'message' => $message])
                        ->with('success', $message);
                } else {
                    $message = 'Registration fail.';
                    return redirect()->route('signup', ['status' => $result, 'message' => $message])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('signup')
                    ->with('error', $message);
            }
        } catch (Exception $e) {
            $message = 'Error occurred.';
            return redirect()->route('signup')
                ->with('error', $message);
        }
    }

    public function signinAction(Request $request)
    {
        try {
            $message = null;
            $isEmailExists = false;
            $userObj = new User();
            $userObj->checkSigninValidation($request);
            $userObj->email = trim($request->input('email'));
            $userObj->password = trim($request->input('password'));
            $userInfo = $userObj->getUserInfoByEmailAndPassword($userObj->email, $userObj->password);
//            getPrintr($userInfo);
            if (!empty($userInfo)) { // if User exists
                $message = 'Login successful.';
                $userObj->setUserSession($userInfo);
//                return redirect('admin/dashboard');
                return redirect()->route('dashboard');
            } else {
                $message = 'Login failed. Please Check Your Login Credentials.';
                return redirect()->route('adminSignin', ['message' => $message])->with('error', $message);
            }
        } catch (Exception $e) {
            $message = 'Error occurred.';
            return redirect()->route('adminSignin')->with('error', $message);
        }
    }

    public function logout()
    {
        try {
            request()->session()->regenerate(true);
            request()->session()->flush();
            $message = 'Logout Successful.';
            return redirect()->route('dashboard')->with('success', $message); // then redirect to home
        } catch (Exception $e) {
            $message = 'Error occurred.';
            return redirect()->route('adminSignin')->with('error', $message);
        }
    }

    public function getSessionData(Request $request)
    {
        try {
            if ($set = $request->session()->has('userSession')) {
                getPrintr($request->session()->get('userSession'));
            } else {
                echo 'no data';
            }
        } catch (Exception $exception) {

        }
    }
}
