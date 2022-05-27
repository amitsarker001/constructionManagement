<?php

namespace App\Http\Controllers\Admin;

use App\Budget;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class BudgetController extends Controller
{
    protected $userObj;
    protected $budgetObj;
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userObj = new User();
        $this->budgetObj = new Budget();
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
                    'pageTitle' => 'Budget',
                    'budgetList' => $this->budgetObj->getAll(),
                );
                return view('admin.budget.index')->with($data);
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
                    'pageTitle' => 'Create Budget',
                    'buttonText' => 'Save',
                );
                return view('admin.budget.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function budgetSave(Request $request)
    {
        try {
            $message = null;
//            $this->budgetObj->checkValidation($request);
            $this->budgetObj->cash_amount = doubleval(trim($request->input('cash_amount')));
            $this->budgetObj->extra_amount_claimed = doubleval(trim($request->input('extra_amount_claimed')));
            $this->budgetObj->total_allocated_funds = doubleval(trim($request->input('total_allocated_funds')));
            $this->budgetObj->funds_remaining = doubleval(trim($request->input('funds_remaining')));
            $this->budgetObj->entry_date = (trim($request->input('entry_date')));
            //$isExists = $this->budgetObj->isColumnValueExist('cost_name', $this->budgetObj->budget_name);
            $isExists = false;
            if (!boolval($isExists)) { // if email does not exists
                $result = $this->budgetObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('budget');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('budgetCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The name has already been taken.';
                return redirect()->route('budgetCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $budgetInfo = $this->budgetObj->getById($id);
            if (!empty($budgetInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Update Budget',
                        'buttonText' => 'Update',
                        'budgetInfo' => $budgetInfo,
                    );
                    return view('admin.budget.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function budgetUpdate(Request $request)
    {
        try {
            $message = null;
//            $this->budgetObj->checkValidation($request);
            $id = intval(trim($request->input('id')));
            $cash_amount = doubleval(trim($request->input('cash_amount')));
            $extra_amount_claimed = doubleval(trim($request->input('extra_amount_claimed')));
            $total_allocated_funds = doubleval(trim($request->input('total_allocated_funds')));
            $funds_remaining = doubleval(trim($request->input('funds_remaining')));
            $entry_date = trim($request->input('entry_date'));
//            $isExists = $this->budgetObj->isColumnValueExist('cost_name', $budgetName, $id);
            $isExists = false;
            if (!boolval($isExists)) { // if name does not exists
                $data = array(
                    'id' => $id,
                    'cash_amount' => $cash_amount,
                    'extra_amount_claimed' => $extra_amount_claimed,
                    'total_allocated_funds' => $total_allocated_funds,
                    'funds_remaining' => $funds_remaining,
                    'entry_date' => $entry_date,
                );
                $isUpdate = $this->budgetObj->updateData($data, $id);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('budget')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('budget', ['message' => $id])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('budgetEdit', ['id' => $id])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function budgetDelete($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $budgetInfo = $this->budgetObj->getById($id);
            if (!empty($budgetInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $isUpdate = $this->budgetObj->deleteWhere(array('id' => $id));
                    if (boolval($isUpdate)) {
                        $message = 'Information has been deleted successfully.';
                        return redirect()->route('budget')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to delete.';
                        return redirect()->route('budget', ['message' => $id])
                            ->with('error', $message);
                    }
                    return view('admin.budget.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }
}
