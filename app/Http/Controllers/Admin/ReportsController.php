<?php

namespace App\Http\Controllers\Admin;

use App\Assessment;
use App\Customer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
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
        return redirect()->route('dashboard');
    }

    public function assessmentReport()
    {
        $userObj = new User();
        $assessmentObj = new Assessment();
        $logginUserId = $userObj->getLoggedinUserId();
        if ($logginUserId > 0) {
            $assessmentList = $assessmentObj->getCustomerAssessmentList();
            $data = array(
                'pageTitle' => 'Assessment Report',
                'assessmentList' => $assessmentList,
            );
            return view('admin.reports.assessment.index')->with($data);
        } else {
            return redirect()->route('adminSignin');
        }
    }

    public function myAssessmentByAssessmentYear(Request $request)
    {
        $modalHtml = '';
        if ($request->ajax()) {
            $customer = new Customer();
            $assessmentObj = new Assessment();
            $assessmentId = intval(trim($request->input('id')));
            $assessmentDetails = $assessmentObj->getCustomerAssessmentDetailsByAssessmentId($assessmentId);
            $modalHtml = view('admin.reports.assessment.assessmentDetailsModal')->with('assessmentDetails', $assessmentDetails);
            echo $modalHtml = $modalHtml->render();
        } else {
            return redirect()->route('/admin');
        }
    }

    public function assessmentGenerateToPdf(Request $request)
    {
        try {
            $assessmentObj = new Assessment();
            $customerObj = new Customer();
            $assessmentId = request()->segment(3);
            if (!empty($assessmentId) && intval($assessmentId) > 0) {
                $assessmentDetails = $assessmentObj->getCustomerAssessmentDetailsByAssessmentId($assessmentId);
                $customerInfo = $customerObj->getById($assessmentDetails->customer_id);
                $assessmentYear = $assessmentDetails->assessment_year;
                $customerName = $customerInfo->customer_name;
                $customerName = preg_replace('/s+/', '', $customerName);
                $currentDateTime = date("YmdHis");
                $fileName = $customerName . '_' . $assessmentYear . '_' . $currentDateTime . '.pdf';
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
                $html = view('admin.reports.assessment.pdfDesign.assessmentDetailsPdf')->with('assessmentDetails', $assessmentDetails);
                $html = $html->render();
                $mpdf->SetHeader('');
                $mpdf->SetFooter('{PAGENO}');
                $mpdf->WriteHTML($html);
                $mpdf->Output($fileName, 'I');
            } else {
                echo '<div style="text-align: center; color: red; font-weight: bold;">Error Occurred. Please contact with us.<br/>' .
                    'Contact Number: ' . getCompanyMobile() . '</div>';
            }
        } catch (\Exception $e) {
            echo '<div style="text-align: center; color: red; font-weight: bold;">Error Occurred while Printing. Please contact with us.<br/>' .
                'Contact Number: ' . getCompanyMobile() . '</div>';
            exit;
        }
    }
}
