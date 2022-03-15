<?php

namespace App\Http\Controllers\Admin;

use App\Miscellaneous;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class MiscellaneousController extends Controller
{
    protected $userObj;
    protected $miscellaneousObj;
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userObj = new User();
        $this->miscellaneousObj = new Miscellaneous();
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if ($logginUserId > 0) {
            $loggedInUserInfo = $this->userObj->getById($logginUserId);
            $userTypeAccessArray = array(1, 3);
            if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                $data = array(
                    'pageTitle' => 'Miscellaneous',
                    'miscellaneousList' => $this->miscellaneousObj->getAll(),
                );
                return view('admin.miscellaneous.index')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function create()
    {
        $this->userObj = new User();
        $logginUserId = $this->userObj->getLoggedinUserId();
        if ($logginUserId > 0) {
            $loggedInUserInfo = $this->userObj->getById($logginUserId);
            $userTypeAccessArray = array(1, 3);
            if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                $data = array(
                    'pageTitle' => 'Create Miscellaneous',
                    'buttonText' => 'Save',
                );
                return view('admin.miscellaneous.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function miscellaneousSave(Request $request)
    {
        try {
            $message = null;
//            $this->miscellaneousObj->checkValidation($request);
            $this->miscellaneousObj->cost_name = trim($request->input('cost_name'));
            $this->miscellaneousObj->quantity = doubleval(trim($request->input('quantity')));
            $this->miscellaneousObj->unit_price = doubleval(trim($request->input('unit_price')));
            $this->miscellaneousObj->total_cost = doubleval(trim($request->input('total_cost')));
            $this->miscellaneousObj->remarks = trim($request->input('remarks'));
            $this->miscellaneousObj->entry_date = trim($request->input('entry_date'));
            //$isExists = $this->miscellaneousObj->isColumnValueExist('cost_name', $this->miscellaneousObj->cost_name);
            $isExists = false;
            if (!boolval($isExists)) { // if email does not exists
                $result = $this->miscellaneousObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('miscellaneous');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('miscellaneousCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The name has already been taken.';
                return redirect()->route('miscellaneousCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $miscellaneousInfo = $this->miscellaneousObj->getById($id);
            if (!empty($miscellaneousInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Update Miscellaneous',
                        'buttonText' => 'Update',
                        'miscellaneousInfo' => $miscellaneousInfo,
                    );
                    return view('admin.miscellaneous.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function miscellaneousUpdate(Request $request)
    {
        try {
            $message = null;
//            $this->miscellaneousObj->checkValidation($request);
            $id = intval(trim($request->input('id')));
            $costName = trim($request->input('cost_name'));
            $quantity = doubleval(trim($request->input('quantity')));
            $unitPrice = doubleval(trim($request->input('unit_price')));
            $totalCost = doubleval(trim($request->input('total_cost')));
            $remarks = trim($request->input('remarks'));
            $entryDate = trim($request->input('entry_date'));
//            $isExists = $this->miscellaneousObj->isColumnValueExist('cost_name', $costName, $id);
            $isExists = false;
            if (!boolval($isExists)) { // if name does not exists
                $data = array(
                    'id' => $id,
                    'cost_name' => $costName,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_cost' => $totalCost,
                    'remarks' => $remarks,
                    'entry_date' => $entryDate,
                );
                $isUpdate = $this->miscellaneousObj->updateData($data, $id);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('miscellaneous')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('miscellaneous', ['message' => $id])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('miscellaneousEdit', ['id' => $id])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function miscellaneousDelete($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $miscellaneousInfo = $this->miscellaneousObj->getById($id);
            if (!empty($miscellaneousInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $isUpdate = $this->miscellaneousObj->deleteWhere(array('id' => $id));
                    if (boolval($isUpdate)) {
                        $message = 'Information has been deleted successfully.';
                        return redirect()->route('miscellaneous')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to delete.';
                        return redirect()->route('miscellaneous', ['message' => $id])
                            ->with('error', $message);
                    }
                    return view('admin.miscellaneous.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }
}
