<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class AdminUserController extends Controller
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
        $logginUserId = $userObj->getLoggedinUserId();
        if (intval($logginUserId) > 0) {
            $userInfo = $userObj->getById($logginUserId);
            $userTypeAccessArray = array(1, 3);
            if (!empty($userInfo) && in_array($userInfo->user_type_id, $userTypeAccessArray)) {
                $userList = $userObj->getAll();
                $data = array(
                    'pageTitle' => 'User',
                    'userList' => $userList,
                );
                return view('admin.adminUser.index')->with($data);
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
        if (intval($logginUserId) > 0) {
            $userInfo = $userObj->getById($logginUserId);
            $userTypeAccessArray = array(1, 3);
            if (!empty($userInfo) && in_array($userInfo->user_type_id, $userTypeAccessArray)) {
                $userTypeArray = $userObj->getUserTypeArray();
                $data = array(
                    'pageTitle' => 'Create User',
                    'buttonText' => 'Save',
                    'userTypeArray' => $userTypeArray,
                );
                return view('admin.adminUser.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function adminUserSave(Request $request)
    {
        try {
            $message = null;
            $isEmailExists = false;
            $userObj = new User();
            $userObj->checkRegistrationValidation($request);
            $userObj->user_name = trim($request->input('user_name'));
            $userObj->email = trim($request->input('email'));
            $userObj->user_type_id = intval(trim($request->input('user_type_id')));
            $userObj->is_active = boolval(trim($request->input('is_active')));
            $userObj->address = trim($request->input('address'));
            $userObj->mobile = trim($request->input('mobile'));
            $userObj->password = trim($request->input('password'));
            $isEmailExists = $userObj->isColumnValueExist('email', $userObj->email);
            if (!boolval($isEmailExists)) { // if email does not exists
                $userObj->password = passwordEncrypt($userObj->password);
                $result = $userObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('adminUser');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('adminUserCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('adminUserCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $userObj = new User();
        $logginUserId = $userObj->getLoggedinUserId();
        if (intval($logginUserId) > 0 && intval($id) > 0) {
            $userInfo = $userObj->getById($id);
            if (!empty($userInfo)) {
                $loggedInUserInfo = $userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $userTypeArray = $userObj->getUserTypeArray();
                    $data = array(
                        'pageTitle' => 'Update User',
                        'buttonText' => 'Update',
                        'userTypeArray' => $userTypeArray,
                        'userInfo' => $userInfo,
                    );
                    return view('admin.adminUser.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function adminUserUpdate(Request $request)
    {
        try {
            $message = null;
            $isEmailExists = false;
            $userObj = new User();
            $userObj->checkRegistrationValidationForUpdate($request);
            $userId = intval(trim($request->input('id')));
            $userName = trim($request->input('user_name'));
            $email = trim($request->input('email'));
            $userTypeId = intval(trim($request->input('user_type_id')));
            $isActive = boolval(trim($request->input('is_active')));
            $address = trim($request->input('address'));
            $mobile = trim($request->input('mobile'));
            $password = trim($request->input('password'));
            $isEmailExists = $userObj->isColumnValueExist('email', $email, $userId);
            if (!boolval($isEmailExists)) { // if email does not exists
                $userData = array(
                    'id' => $userId,
                    'user_name' => $userName,
                    'email' => $email,
                    'user_type_id' => $userTypeId,
                    'is_active' => $isActive,
                    'address' => $address,
                    'mobile' => $mobile,
                );
                if (!empty($password)) {
                    $userData['password'] = passwordEncrypt($password);
                }
                $isUpdate = $userObj->updateData($userData, $userId);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('adminUser')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('adminUser', ['message' => $userId])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('adminUserEdit', ['id' => $userId])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function userProfile()
    {
        $userObj = new User();
        $logginUserId = $userObj->getLoggedinUserId();
        if (intval($logginUserId) > 0) {
            $userInfo = $userObj->getById($logginUserId);
            $data = array(
                'pageTitle' => 'My Profile',
                'buttonText' => 'Update',
                'userInfo' => $userInfo,
            );
            return view('admin.adminUser.userProfile')->with($data);
        }
        return redirect()->route('adminSignin');
    }

    public function userProfileUpdateAction(Request $request)
    {
        try {
            $message = null;
            $isEmailExists = false;
            $userObj = new User();
            $userObj->checkUserProfileValidation($request);
            $userId = $userObj->getLoggedinUserId();
            if ($userId > 0) {
                $userName = trim($request->input('user_name'));
                $email = trim($request->input('email'));
                $address = trim($request->input('address'));
                $mobile = trim($request->input('mobile'));
                $password = trim($request->input('password'));
                $isEmailExists = $userObj->isColumnValueExist('email', $email, $userId);
                if (!boolval($isEmailExists)) { // if email does not exists
                    $userData = array(
                        'id' => $userId,
                        'user_name' => $userName,
//                    'email' => $email,
                        'address' => $address,
                        'mobile' => $mobile,
                    );
                    if (!empty($password)) {
                        $userData['password'] = passwordEncrypt($password);
                    }
                    $isUpdate = $userObj->updateData($userData, $userId);
                    if (boolval($isUpdate)) {
                        $userInfo = $userObj->getById($userId);
                        $userObj->setUserSession($userInfo);
                        $message = 'Information has been updated successfully.';
                        return redirect()->route('adminUserProfile')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to update.';
                        return redirect()->route('adminUserProfile', ['message' => $userId])
                            ->with('error', $message);
                    }
                } else {
                    $message = 'The email has already been taken.';
                    return redirect()->route('adminUserProfile', ['id' => $userId])
                        ->with('error', $message);
                }
            } else {
                return redirect()->route('adminSignin');
            }
        } catch (Exception $e) {

        }
    }
}
