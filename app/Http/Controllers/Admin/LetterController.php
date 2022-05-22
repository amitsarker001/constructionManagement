<?php

namespace App\Http\Controllers\Admin;

use App\Letter;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class LetterController extends Controller
{
    protected $userObj;
    protected $letterObj;
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
        $this->letterObj = new Letter();
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
                    'pageTitle' => 'Letter',
                    'letterList' => $this->letterObj->getAll(),
                );
                return view('admin.letter.index')->with($data);
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
                    'pageTitle' => 'Create letter',
                    'buttonText' => 'Save',
                );
                return view('admin.letter.add')->with($data);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect()->route('adminSignin');
    }

    public function letterSave(Request $request)
    {
        try {
            $message = null;
            $this->letterObj->supplier_id = trim($request->input('supplier_id'));
            $this->letterObj->entry_date = trim($request->input('entry_date'));
            $this->letterObj->subject = trim($request->input('subject'));
            $this->letterObj->description = trim($request->input('description'));
            $this->letterObj->user_id = $this->userObj->getLoggedinUserId();
            $isExists = false;
            if (!boolval($isExists)) { // if does not exists
                $result = $this->letterObj->save();
                if (boolval($result)) {
                    $message = 'Information has been saved successfully.';
                    return redirect()->route('letter');
                } else {
                    $message = 'Failed to save.';
                    return redirect()->route('letterCreate')
                        ->with('error', $message);
                }
            } else {
                $message = 'The name has already been taken.';
                return redirect()->route('letterCreate')
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function edit($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $letterInfo = $this->letterObj->getById($id);
            if (!empty($letterInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $data = array(
                        'pageTitle' => 'Update Letter',
                        'buttonText' => 'Update',
                        'letterInfo' => $letterInfo,
                    );
                    return view('admin.letter.edit')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function letterUpdate(Request $request)
    {
        try {
            $message = null;
            $id = intval(trim($request->input('id')));
            $supplierId = intval(trim($request->input('supplier_id')));
            $entryDate = trim($request->input('entry_date'));
            $subject = trim($request->input('subject'));
            $description = trim($request->input('description'));
            $isExists = false;
            if (!boolval($isExists)) { // if does not exists
                $data = array(
                    'id' => $id,
                    'supplier_id' => $supplierId,
                    'entry_date' => $entryDate,
                    'subject' => $subject,
                    'description' => $description,
                );
                $isUpdate = $this->letterObj->updateData($data, $id);
                if (boolval($isUpdate)) {
                    $message = 'Information has been updated successfully.';
                    return redirect()->route('letter')
                        ->with('success', $message);
                } else {
                    $message = 'Failed to update.';
                    return redirect()->route('letter', ['message' => $id])
                        ->with('error', $message);
                }
            } else {
                $message = 'The email has already been taken.';
                return redirect()->route('letterEdit', ['id' => $id])
                    ->with('error', $message);
            }
        } catch (Exception $e) {

        }
    }

    public function letterDelete($id = 0)
    {
        $logginUserId = $this->userObj->getLoggedinUserId();
        if (($logginUserId) > 0 && intval($id) > 0) {
            $letterInfo = $this->letterObj->getById($id);
            if (!empty($letterInfo)) {
                $loggedInUserInfo = $this->userObj->getById($logginUserId);
                $userTypeAccessArray = array(1, 3);
                if (!empty($loggedInUserInfo) && in_array($loggedInUserInfo->user_type_id, $userTypeAccessArray)) {
                    $isUpdate = $this->letterObj->deleteWhere(array('id' => $id));
                    if (boolval($isUpdate)) {
                        $message = 'Information has been deleted successfully.';
                        return redirect()->route('letter')
                            ->with('success', $message);
                    } else {
                        $message = 'Failed to delete.';
                        return redirect()->route('letter', ['message' => $id])
                            ->with('error', $message);
                    }
                    return view('admin.letter.index')->with($data);
                } else {
                    return redirect('admin/dashboard');
                }
            } else {

            }
        }
        return redirect()->route('adminSignin');
    }

    public function letterDetailsPrint(Request $request)
    {
        try {
            $modalHtml = '';
            if ($request->ajax()) {
                $letterId = intval(trim($request->input('id')));
                $letterDetails = $this->letterObj->getById($letterId);
                $modalHtml = view('admin.letter.letterDetailsPrint')->with('letterDetails', $letterDetails);
                echo $modalHtml = $modalHtml->render();
            } else {
                return redirect()->route('/admin');
            }
        } catch (\Exception $e) {

        }
    }

    public function letterPrintToPdf(Request $request)
    {
        try {
            $letterId = request()->segment(4);
            if (!empty($letterId) && intval($letterId) > 0) {
                $letterDetails = $this->letterObj->getById($letterId);
                $supplierInfo = $this->supplierObj->getById($letterDetails->supplier_id);
                $supplierName = !empty($supplierInfo->supplier_name) ? $supplierInfo->supplier_name : '';
                $supplierName = preg_replace('/s+/', '', $supplierName);
                $currentDateTime = date("YmdHis");
                $fileName = $currentDateTime . '.pdf';
                $fileName = str_replace("-", "_", $fileName);
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_top' => 15,
                    'margin_bottom' => 20,
                    'margin_header' => 10,
                    'margin_footer' => 10,
                ]);
                $html = view('admin.letter.pdfDesign.letterDetailsPdf')->with('letterDetails', $letterDetails);
                $html = $html->render();
                $mpdf->SetHeader('');
                //$mpdf->SetFooter('{PAGENO}');
                $mpdf->WriteHTML($html);
                $mpdf->Output($fileName, 'I');
            } else {
                echo '<div style="text-align: center; color: red; font-weight: bold;">Error Occurred.<br/>' . '</div>';
            }
        } catch (\Exception $e) {
            echo '<div style="text-align: center; color: red; font-weight: bold;">Error Occurred while Printing<br/>' . '</div>';
            exit;
        }
    }
}
