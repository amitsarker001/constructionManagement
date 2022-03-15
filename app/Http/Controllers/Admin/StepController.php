<?php

namespace App\Http\Controllers\Admin;

use App\Step;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class StepController extends Controller
{
    protected $userObj;
    protected $stepObj;
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
                    'pageTitle' => 'Step',
                    'stepList' => $this->stepObj->getAll(),
                );
                return view('admin.step.index')->with($data);
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
                    'pageTitle' => 'Create Step',
                    'buttonText' => 'Save',
                );
                return view('admin.step.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function stepSave(Request $request)
    {
        try {
            $message = null;
//            $this->stepObj->checkValidation($request);
            $this->stepObj->step_name = trim($request->input('step_name'));
            $this->stepObj->start_date = trim($request->input('start_date'));
            $this->stepObj->end_date = trim($request->input('end_date'));
            $this->stepObj->description = trim($request->input('description'));
            //$isExists = $this->stepObj->isColumnValueExist('cost_name', $this->stepObj->step_name);
            $isExists = false;
            if (!boolval($isExists)) { // if email does not exists
                $result = $this->stepObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('step');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('stepCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The name has already been taken.';
                return redirect()->route('stepCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $stepInfo = $this->stepObj->getById($id);
            if (!empty($stepInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Update Step',
                        'buttonText' => 'Update',
                        'stepInfo' => $stepInfo,
                    );
                    return view('admin.step.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function stepUpdate(Request $request)
    {
        try {
            $message = null;
//            $this->stepObj->checkValidation($request);
            $id = intval(trim($request->input('id')));
            $stepName = trim($request->input('step_name'));
            $startDate = trim($request->input('start_date'));
            $endDate = trim($request->input('end_date'));
            $description = trim($request->input('description'));
//            $isExists = $this->stepObj->isColumnValueExist('cost_name', $stepName, $id);
            $isExists = false;
            if (!boolval($isExists)) { // if name does not exists
                $data = array(
                    'id' => $id,
                    'step_name' => $stepName,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'description' => $description,
                );
                $isUpdate = $this->stepObj->updateData($data, $id);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('step')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('step', ['message' => $id])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('stepEdit', ['id' => $id])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function stepDelete($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $stepInfo = $this->stepObj->getById($id);
            if (!empty($stepInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $isUpdate = $this->stepObj->deleteWhere(array('id' => $id));
                    if (boolval($isUpdate)) {
                        $message = 'Information has been deleted successfully.';
                        return redirect()->route('step')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to delete.';
                        return redirect()->route('step', ['message' => $id])
                            ->with('error', $message);
                    }
                    return view('admin.step.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }
}
