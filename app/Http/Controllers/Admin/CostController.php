<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\User;
use App\Cost;
use App\Step;
use App\Cost_details;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use Session;

class CostController extends Controller
{

    protected $stepObj;
    protected $itemObj;
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
        $this->stepObj = new Step();
        $this->itemObj = new Item();
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
        try {
            $userObj = new User();
            $logginUserId = $userObj->getLoggedinUserId();
            if ($logginUserId > 0) {
                $loggedInUserInfo = $userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Material Cost',
                        'costList' => $this->costObj->getAll(),
                    );
                    return view('admin.cost.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            }
            return redirect()->route('adminSignin');
        } catch (\Exception $e) {

        }
    }

    public function create()
    {
        try {
            $this->clearDetailsFromTable();
            $userObj = new User();
            $logginUserId = $userObj->getLoggedinUserId();
            if ($logginUserId > 0) {
                $loggedInUserInfo = $userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Create New',
                        'buttonText' => 'Save',
                        'stepList' => $this->stepObj->getAll(),
                        'itemList' => $this->itemObj->getAll(),
                    );
                    return view('admin.cost.add')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            }
            return redirect()->route('adminSignin');
        } catch (\Exception $e) {

        }
    }

    public function addDetailsToTable(Request $request)
    {
        try {
            $message = '';
            $tableHtml = '';
            if ($request->ajax()) {
                $item_id = intval(trim($request->input('item_id')));
                $quantity = doubleval(trim($request->input('quantity')));
                $rate = doubleval(trim($request->input('rate')));
                $amount = doubleval(trim($request->input('amount')));
                $standard_rate = doubleval(trim($request->input('standard_rate')));
                $standard_amount = doubleval(trim($request->input('standard_amount')));
                $increase_rate = doubleval(trim($request->input('increase_rate')));
                $increase_amount = doubleval(trim($request->input('increase_amount')));
                if ($item_id >= 0) {
                    if ($quantity >= 0) {
                        if ($amount >= 0) {
                            $items = session()->get('arraydetailsSession');
                            $item_table_array = $items;
                            //$stepInfo = $this->stepObj->getById($step_id);
                            $itemInfo = $this->itemObj->getById($item_id);
                            $item_details = [
                                'array_id' => time(),
                                'item_id' => $item_id,
                                'item_name' => (!empty($itemInfo)) ? $itemInfo->item_name : '',
                                'quantity' => $quantity,
                                'rate' => $rate,
                                'amount' => $amount,
                                'standard_rate' => $standard_rate,
                                'standard_amount' => $standard_amount,
                                'increase_rate' => $increase_rate,
                                'increase_amount' => $increase_amount,
                            ];
                            if (!empty($item_table_array)) {
                                array_push($item_table_array, $item_details);
                            } else {
                                $item_table_array = array();
                                array_push($item_table_array, $item_details);
                            }
                            request()->session()->put('arraydetailsSession', $item_table_array);
                            $arraydetailsSession = session()->get('arraydetailsSession');
                            //return response()->json(['tableArray' => $arraydetailsSession, 'message' => $message], (200))->header('Content-Type', 'application/json'); // Status code here
                        } else {
                            $message = "Please enter a valid amount.";
                        }
                    } else {
                        $message = "Please enter a valid quantity.";
                    }
                } else {
                    $message = "Please Select Item.";
                }
                $tableHtml = view('admin.cost.detailsTable')->with('detailsTable', $arraydetailsSession);
                echo $tableHtml = $tableHtml->render();
            } else {
                return redirect()->route('costCreate')->with('error', $message = '');
            }
        } catch (\Exception $e) {

        }
    }

    public function removeDetailsFromTable(Request $request)
    { //delete item info from table
        $message = '';
        try {
            if ($request->ajax()) {
                $array_id = intval(trim($request->input('id')));
                $items = session()->get('arraydetailsSession');
                if ((!empty($items))) {
                    $item_table_array = array();
                    foreach ($items as $item) {
                        if ($array_id != $item['array_id']) {
                            array_push($item_table_array, $item);
                        }
                    }
                    request()->session()->put('arraydetailsSession', $item_table_array);
                    $arraydetailsSession = session()->get('arraydetailsSession');
                    $tableHtml = view('admin.cost.detailsTable')->with('detailsTable', $arraydetailsSession);
                    echo $tableHtml = $tableHtml->render();
                }
            }
        } catch (\Exception $e) {

        }
        //return redirect()->route('costCreate')->with('error', $message);
    }

    public function costSave(Request $request)
    {
        try {
            if ($request->ajax()) {
                $message = '';
                $statusId = 0;
                $this->costObj->step_id = intval(trim($request->input('step_id')));
                $this->costObj->entry_date = trim($request->input('entry_date'));
                $items = session()->get('arraydetailsSession');
                if ((!empty($items))) {
                    $result = $this->costObj->save();
                    if (boolval($result)) {
                        $insertedCostId = intval($this->costObj->id);
                        if ($insertedCostId > 0) {
                            $detailsData = [];
                            foreach ($items as $item) {
                                $data = [
                                    'cost_id' => $insertedCostId,
                                    'item_id' => $item['item_id'],
                                    'quantity' => $item['quantity'],
                                    'rate' => $item['rate'],
                                    'amount' => $item['amount'],
                                    'standard_rate' => $item['standard_rate'],
                                    'standard_amount' => $item['standard_amount'],
                                    'increase_rate' => $item['increase_rate'],
                                    'increase_amount' => $item['increase_amount']
                                ];
                                array_push($detailsData, $data);
                            }
                            if (!empty($detailsData)) {
                                Cost_details::insert($detailsData);
                                $this->clearDetailsFromTable();
                                $message = 'Information has been saved successfully.';
                                $statusId = 1;
                            }
                        } else {
                            $message = 'Failed to save.';
                        }
                    } else {
                        $message = 'Failed to save.';
                    }
                } else {
                    $message = 'No data in table. Please add items.';
                }
                $array = ['statusId' => $statusId, 'message' => $message, 'redirectUrl' => route('costCreate')];
                return response()->json($array, 200,
                    [
                        'Content-Type' => 'application/json',
                        'Charset' => 'utf-8'
                    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
        } catch (Exception $e) {

        }
    }

    public function stepWiseCostDetails(Request $request)
    {
        try {
            $modalHtml = '';
            if ($request->ajax()) {
                $costId = intval(trim($request->input('id')));
                $costInfo = $this->costObj->getById($costId);
                $stepInfo = $this->stepObj->getById($costInfo->step_id);
                $costDetails = $this->costDetailsObj->getWhere(['cost_id' => $costId]);
                $data = array(
                    'pageTitle' => 'Details Information',
                    'costInfo' => $costInfo,
                    'stepInfo' => $stepInfo,
                    'costDetails' => $costDetails,
                );
                $modalHtml = view('admin.cost.costDetailsModal')->with('data', $data);
                echo $modalHtml = $modalHtml->render();
            } else {
                return redirect()->route('/admin');
            }
        } catch (\Exception $e) {

        }
    }

    public function clearDetailsFromTable()
    {
        try {
            $message = '';
            $items = session()->get('arraydetailsSession');
            if ((!empty($items))) {
                request()->session()->forget('arraydetailsSession');
            }
            return redirect()->route('costCreate')->with('error', $message);
        } catch (\Exception $e) {

        }
    }

    public function costDelete($id = 0)
    {
        try {
            $userObj = new User();
            $logginUserId = $userObj->getLoggedinUserId();
            if (($logginUserId) > 0 && intval($id) > 0) {
                $costInfo = $this->costObj->getById($id);
                if (!empty($costInfo)) {
                    $loggedInUserInfo = $userObj->getById($logginUserId);
                    $userTypeAccessArray = array(1, 3);
                    if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                        $isUpdate = $this->costObj->deleteWhere(array('id' => $id));
                        if (boolval($isUpdate)) {
                            $this->costDetailsObj->deleteWhere(array('cost_id' => $id));
                            $message = 'Information has been deleted successfully.';
                            return redirect()->route('cost')
                                ->with('success', $message);
                        } else {
                            $message = 'Failed to delete.';
                            return redirect()->route('cost', ['message' => $id])
                                ->with('error', $message);
                        }
                        return view('admin.cost.index')->with($data);
                    } else {
                        return redirect('admin/dashboard');
                    }
                } else {

                }
            }
            return redirect()->route('adminSignin');
        } catch (\Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        return redirect('admin/dashboard');
    }

    public function itemUpdate(Request $request)
    {
        return redirect('admin/dashboard');
    }

}
