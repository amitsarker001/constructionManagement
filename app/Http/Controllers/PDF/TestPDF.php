<?php

namespace App\Http\Controllers\PDF;

use App\Assessment;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestPDF extends Controller
{
    //
    public function generate()
    {
        try {
            $customerObj = new Customer();
            $data = $customerObj->getWhere(array('id' => 1));
            $fileName = date("Y_m_d_H_i_s") . '.pdf';
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

            $assessmentObj = new Assessment();
//        $assessmentId = intval(trim($request->input('id')));
            $assessmentDetails = $assessmentObj->getCustomerAssessmentDetails(1, 1);
            $html = view('myProfile.pdfDesign.assessmentDetailsPdf')->with('assessmentDetails', $assessmentDetails);
//        $modalHtml = $modalHtml->render();

//            $html = view('pdf.demo', compact($data));
//        $html = \view::make('pdf.demo')->with('data', $data);
            $html = $html->render();
//            echo $html;exit;
            $mpdf->SetHeader('');
            $mpdf->SetFooter('{PAGENO}');
//            $mpdf->SetWatermarkText('DRAFT', 0.2);
//            $mpdf->showWatermarkText = true;
            $stylesheet = '';
//            getPrintr(url('/assets/plugins/bootstrap/bootstrap.min.css'));
//            $stylesheet = file_get_contents(('/assets/css/custom.css'));
//            $mpdf->WriteHTML($stylesheet, 1);
            $mpdf->WriteHTML($html);
            $mpdf->Output($fileName, 'I');

//        return view('pdf.demo', compact($data));
        } catch (\Exception $e) {
            print_r($e);exit;
        }
    }
}
