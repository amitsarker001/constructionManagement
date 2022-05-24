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
    }

    public function supplierwiseReportView(Request $request)
    {
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
    }

    public function costSummaryReport()
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if ($logginUserId > 0) {
            $data = array(
                'pageTitle' => 'Cost Summary Report',
                'stepList' => $this->stepObj->getAll(),
                'isAjax' => false,
                'costSummaryReport' => $this->costDetailsObj->getSupplierwiseList(),
            );
            return view('admin.reports.cost_summary.index')->with($data);
        } else {
            return redirect()->route('adminSignin');
        }
    }

    public function costSummaryReportView(Request $request)
    {
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
