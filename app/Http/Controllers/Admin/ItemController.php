<?php

namespace App\Http\Controllers\Admin;

use App\Item;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class ItemController extends Controller
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
        $itemObj = new Item();
        $logginUserId = $userObj->getLoggedinUserId();
        if ($logginUserId > 0) {
            $loggedInUserInfo = $userObj->getById($logginUserId);
            $userTypeAccessArray = array(1, 3);
            if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                $data = array(
                    'pageTitle' => 'Item',
                    'itemList' => $itemObj->getAll(),
                );
                return view('admin.item.index')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function create()
    {
        $userObj = new User();
        $logginUserId = $userObj->getLoggedinUserId();
        if ($logginUserId > 0) {
            $loggedInUserInfo = $userObj->getById($logginUserId);
            $userTypeAccessArray = array(1, 3);
            if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                $data = array(
                    'pageTitle' => 'Create Item',
                    'buttonText' => 'Save',
                    'unitArray' => getUnitArray(),
                );
                return view('admin.item.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function itemSave(Request $request)
    {
        try {
            $message = null;
            $itemObj = new Item();
            $itemObj->checkValidation($request);
            $itemObj->item_name = trim($request->input('item_name'));
            $itemObj->item_code = trim($request->input('item_code'));
            $itemObj->unit = trim($request->input('unit'));
            $itemObj->unit_price = intval(trim($request->input('unit_price')));
            $itemObj->standard_rate = doubleval(trim($request->input('standard_rate')));
            $itemObj->standard_amount = doubleval(trim($request->input('standard_amount')));
            $itemObj->item_description = trim($request->input('item_description'));
            $itemObj->is_active = boolval(trim($request->input('is_active')));
            $isExists = $itemObj->isColumnValueExist('item_name', $itemObj->item_name);
            if (!boolval($isExists)) { // if email does not exists
                $result = $itemObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('item');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('itemCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The name has already been taken.';
                return redirect()->route('itemCreate')
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
                    return view('admin.item.edit')->with($data);
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
            $standardRate = doubleval(trim($request->input('standard_rate')));
            $standardAmount = doubleval(trim($request->input('standard_amount')));
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
                    'standard_rate' => $standardRate,
                    'standard_amount' => $standardAmount,
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
                    return view('admin.item.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function getDetailsByItemId(Request $request)
    {
        try {
            if ($request->ajax()) {
                $itemObj = new Item();
                $itemId = intval(trim($request->input('id')));
                $itemInfo = $itemObj->getById($itemId);
                return response()->json(['itemInfo' => $itemInfo, 'message' => ''], (200))->header('Content-Type', 'application/json'); // Status code here
            } else {
                return redirect()->route('/admin');
            }
        } catch (\Exception $e) {

        }
    }
}
