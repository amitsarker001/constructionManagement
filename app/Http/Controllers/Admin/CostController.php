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
    }

    public function create()
    {
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
    }

    public function addDetailsToTable(Request $request)
    {
        //$request->session()->forget('arraydetailsSession');exit;
        //echo '<pre>'; \print_r(session()->all());exit;
        $message = '';
        //$step_id = intval(trim($request->input('step_id')));
        //$entry_date = trim($request->input('entry_date'));
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
        return redirect()->route('costCreate')->with('error', $message);
    }

    public function removeDetailsFromTable($id = 0)
    { //delete item info from table
        $message = '';
        $array_id = $id;
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
        }
        return redirect()->route('costCreate')->with('error', $message);
    }

    public function clearDetailsFromTable()
    {
        $message = '';
        $items = session()->get('arraydetailsSession');
        if ((!empty($items))) {
            request()->session()->forget('arraydetailsSession');
        }
        return redirect()->route('costCreate')->with('error', $message);
    }

    public function costSave(Request $request)
    {
        try {
            $message = null;
            //$itemObj->checkValidation($request);
            $this->costObj->step_id = intval(trim($request->input('step_id')));
            $this->costObj->entry_date = trim($request->input('entry_date'));
            $items = session()->get('arraydetailsSession');
            if ((!empty($items))) {
                $result = $this->costObj->save();
                if (boolval($result)) {
                    foreach ($items as $item) {
                        $this->costDetailsObj->cost_id = $this->costObj->id;
                        $this->costDetailsObj->item_id = $item['item_id'];
                        $this->costDetailsObj->quantity = $item['quantity'];
                        $this->costDetailsObj->rate = $item['rate'];
                        $this->costDetailsObj->amount = $item['amount'];
                        $this->costDetailsObj->standard_rate = $item['standard_rate'];
                        $this->costDetailsObj->standard_amount = $item['standard_amount'];
                        $this->costDetailsObj->increase_rate = $item['increase_rate'];
                        $this->costDetailsObj->increase_amount = $item['increase_amount'];
                        $this->costDetailsObj->save();
                    }
                    $this->clearDetailsFromTable();
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('cost');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('costCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'No data in table.';
                return redirect()->route('costCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $userObj = new User();
        $itemObj = new Item();
        $logginUserId = $userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $itemInfo = $itemObj->getById($id);
            if (!empty($itemInfo)) {
                $loggedInUserInfo = $userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Update Item',
                        'buttonText' => 'Update',
                        'unitArray' => getUnitArray(),
                        'itemInfo' => $itemInfo,
                    );
                    return view('admin.cost.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function itemUpdate(Request $request)
    {
        try {
            $message = null;
            $userObj = new User();
            $itemObj = new Item();
            $itemObj->checkValidation($request);
            $id = intval(trim($request->input('id')));
            $itemName = trim($request->input('item_name'));
            $itemCode = trim($request->input('item_code'));
            $unit = trim($request->input('unit'));
            $unitPrice = intval(trim($request->input('unit_price')));
            $itemDescription = trim($request->input('item_description'));
            $isActive = boolval(trim($request->input('is_active')));
            $isExists = $itemObj->isColumnValueExist('item_name', $itemName, $id);
            if (!boolval($isExists)) { // if name does not exists
                $data = array(
                    'id' => $id,
                    'item_name' => $itemName,
                    'item_code' => $itemCode,
                    'unit' => $unit,
                    'unit_price' => $unitPrice,
                    'item_description' => $itemDescription,
                    'is_active' => $isActive,
                );
                $isUpdate = $itemObj->updateData($data, $id);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('item')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('item', ['message' => $id])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('itemEdit', ['id' => $id])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function itemDelete($id = 0)
    {
        $userObj = new User();
        $itemObj = new Item();
        $logginUserId = $userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $itemInfo = $itemObj->getById($id);
            if (!empty($itemInfo)) {
                $loggedInUserInfo = $userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $isUpdate = $itemObj->deleteWhere(array('id' => $id));
                    if (boolval($isUpdate)) {
                        $message = 'Information has been deleted successfully.';
                        return redirect()->route('item')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to delete.';
                        return redirect()->route('item', ['message' => $id])
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
    }
}
