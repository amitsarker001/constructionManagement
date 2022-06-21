<?php

namespace App\Http\Controllers\Admin;

use App\Receive_details;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class ReceiveDetailsController extends Controller
{
    protected $userObj;
    protected $receiveDetailsObj;
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userObj = new User();
        $this->receiveDetailsObj = new Receive_details();
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
                    'pageTitle' => 'Receive Details',
                    'receiveDetailsList' => $this->receiveDetailsObj->getAll(),
                );
                return view('admin.receive_details.index')->with($data);
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
                    'pageTitle' => 'Create Receive Details',
                    'buttonText' => 'Save',
                );
                return view('admin.receive_details.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function receiveDetailsSave(Request $request)
    {
        try {
            $message = null;
//            $this->receiveDetailsObj->checkValidation($request);
            $this->receiveDetailsObj->entry_date = trim($request->input('entry_date'));
            $this->receiveDetailsObj->receive_amount = doubleVal(trim($request->input('receive_amount')));
            $this->receiveDetailsObj->money_receipt_no = (trim($request->input('money_receipt_no')));
            $this->receiveDetailsObj->remarks = trim($request->input('remarks'));
            //$isExists = $this->receiveDetailsObj->isColumnValueExist('cost_name', $this->receiveDetailsObj->receive_amount);
            $isExists = false;
            if (!boolval($isExists)) { // if email does not exists
                $result = $this->receiveDetailsObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('receiveDetails');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('receiveDetailsCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The name has already been taken.';
                return redirect()->route('receiveDetailsCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $receiveDetailsInfo = $this->receiveDetailsObj->getById($id);
            if (!empty($receiveDetailsInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Update Receive Details',
                        'buttonText' => 'Update',
                        'receiveDetailsInfo' => $receiveDetailsInfo,
                    );
                    return view('admin.receive_details.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function receiveDetailsUpdate(Request $request)
    {
        try {
            $message = null;
//            $this->receiveDetailsObj->checkValidation($request);
            $id = intval(trim($request->input('id')));
            $entryDate = trim($request->input('entry_date'));
            $receiveAmount = trim($request->input('receive_amount'));
            $moneyReceiptNo = trim($request->input('money_receipt_no'));
            $remarks = trim($request->input('remarks'));
//            $isExists = $this->receiveDetailsObj->isColumnValueExist('receive_amount', $receiveAmount, $id);
            $isExists = false;
            if (!boolval($isExists)) { // if name does not exists
                $data = array(
                    'id' => $id,
                    'entry_date' => $entryDate,
                    'receive_amount' => $receiveAmount,
                    'money_receipt_no' => $moneyReceiptNo,
                    'remarks' => $remarks,
                );
                $isUpdate = $this->receiveDetailsObj->updateData($data, $id);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('receiveDetails')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('receiveDetails', ['message' => $id])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('receiveDetailsEdit', ['id' => $id])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function receiveDetailsDelete($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $receiveDetailsInfo = $this->receiveDetailsObj->getById($id);
            if (!empty($receiveDetailsInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $isUpdate = $this->receiveDetailsObj->deleteWhere(array('id' => $id));
                    if (boolval($isUpdate)) {
                        $message = 'Information has been deleted successfully.';
                        return redirect()->route('receiveDetails')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to delete.';
                        return redirect()->route('receiveDetails', ['message' => $id])
                            ->with('error', $message);
                    }
                    return view('admin.receive_details.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }
}
