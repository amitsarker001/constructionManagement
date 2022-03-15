<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class SupplierController extends Controller
{
    protected $userObj;
    protected $supplierObj;
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userObj = new User();
        $this->supplierObj = new Supplier();
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
                    'pageTitle' => 'Supplier',
                    'supplierList' => $this->supplierObj->getAll(),
                );
                return view('admin.supplier.index')->with($data);
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
                    'pageTitle' => 'Create Supplier',
                    'buttonText' => 'Save',
                );
                return view('admin.supplier.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function supplierSave(Request $request)
    {
        try {
            $message = null;
//            $this->supplierObj->checkValidation($request);
            $this->supplierObj->supplier_name = trim($request->input('supplier_name'));
            $this->supplierObj->address = trim($request->input('address'));
            $this->supplierObj->is_active = boolval(trim($request->input('is_active')));
            $isExists = $this->supplierObj->isColumnValueExist('supplier_name', $this->supplierObj->supplier_name);
            if (!boolval($isExists)) { // if email does not exists
                $result = $this->supplierObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('supplier');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('supplierCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The name has already been taken.';
                return redirect()->route('supplierCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $supplierInfo = $this->supplierObj->getById($id);
            if (!empty($supplierInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Update Supplier',
                        'buttonText' => 'Update',
                        'supplierInfo' => $supplierInfo,
                    );
                    return view('admin.supplier.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function supplierUpdate(Request $request)
    {
        try {
            $message = null;
//            $this->supplierObj->checkValidation($request);
            $id = intval(trim($request->input('id')));
            $supplierName = trim($request->input('supplier_name'));
            $address = trim($request->input('address'));
            $isActive = boolval(trim($request->input('is_active')));
            $isExists = $this->supplierObj->isColumnValueExist('supplier_name', $supplierName, $id);
            if (!boolval($isExists)) { // if name does not exists
                $data = array(
                    'id' => $id,
                    'supplier_name' => $supplierName,
                    'address' => $address,
                    'is_active' => $isActive,
                );
                $isUpdate = $this->supplierObj->updateData($data, $id);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('supplier')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('supplier', ['message' => $id])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('supplierEdit', ['id' => $id])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function supplierDelete($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $supplierInfo = $this->supplierObj->getById($id);
            if (!empty($supplierInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $isUpdate = $this->supplierObj->deleteWhere(array('id' => $id));
                    if (boolval($isUpdate)) {
                        $message = 'Information has been deleted successfully.';
                        return redirect()->route('supplier')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to delete.';
                        return redirect()->route('supplier', ['message' => $id])
                            ->with('error', $message);
                    }
                    return view('admin.supplier.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }
}
