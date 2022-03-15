<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
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
        if (intval($logginUserId) > 0) {
            return view('admin.dashboard.index');
        }
        return redirect()->route('adminSignin');
    }
}
