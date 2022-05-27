<?php

namespace App\Http\Controllers\Admin;

use App\Cost;
use App\Cost_details;
use App\Item;
use App\Step;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    protected $userObj;
    protected $stepObj;
    protected $itemObj;
    protected $supplierObj;
    protected $costObj;
    protected $costDetailsObj;
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userObj = new User();
        $this->stepObj = new Step();
        $this->itemObj = new Item();
        $this->supplierObj = new Supplier();
        $this->costObj = new Cost();
        $this->costDetailsObj = new Cost_details();
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function supplierwiseReport()
    {
        try {
            $logginUserId = $this->userObj->getLoggedinUserId();
            if ($logginUserId > 0) {
                $data = array(
                    'pageTitle' => 'Supplierwise Report',
                    'supplierList' => $this->supplierObj->getAll(),
                    'isAjax' => false,
                    'supplierwiseReport' => $this->costDetailsObj->getSupplierwiseList(),
                );
                return view('admin.reports.supplierwise.index')->with($data);
            } else {
                return redirect()->route('adminSignin');
            }
        } catch (Exception $ex) {

        }
    }

    public function supplierwiseReportView(Request $request)
    {
        try {
            if ($request->ajax()) {
                $logginUserId = $this->userObj->getLoggedinUserId();
                if ($logginUserId > 0) {
                    $supplierId = intval(trim($request->input('supplier_id')));
                    $status = trim($request->input('status'));
                    $status = (!empty($status) && $status != 'All') ? $status : '';
                    $supplierwiseReport = $this->costDetailsObj->getSupplierwiseList($supplierId, $status);
                    $data = array(
                        'pageTitle' => 'Supplierwise Report',
                        'supplierList' => $this->supplierObj->getAll(),
                        'isAjax' => true,
                        'supplierwiseReport' => $supplierwiseReport,
                    );
                    $html = view('admin.reports.supplierwise.list')->with('data', $data);
                    echo $html = $html->render();
                } else {
                    return redirect()->route('adminSignin');
                }
            } else {
                $this->supplierwiseReport();
            }
        } catch (Exception $ex) {

        }
    }

    public function costSummaryReport()
    {
        try {
            $logginUserId = $this->userObj->getLoggedinUserId();
            if ($logginUserId > 0) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Cost Summary',
                        'costList' => $this->costObj->getAll(),
                    );
                    return view('admin.reports.cost_summary.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            }
            return redirect()->route('adminSignin');
        } catch (\Exception $e) {

        }
    }

    public function costSummaryReportView(Request $request)
    {
        if ($request->ajax()) {
            $logginUserId = $this->userObj->getLoggedinUserId();
            if ($logginUserId > 0) {
                $step_id = intval(trim($request->input('step_id')));
                $data = array(
                    'pageTitle' => 'Cost Summary',
                    'costList' => $this->costObj->getAll(),
                );
                $html = view('admin.reports.cost_summary.list')->with('data', $data);
                echo $html = $html->render();
            } else {
                return redirect()->route('adminSignin');
            }
        } else {
            $this->costSummaryReport();
        }
    }

}
