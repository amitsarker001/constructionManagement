<?php
/**
 * Created By: Amit Sarker
 * Created Date: 20-09-2020
 */
?>
@extends('admin.layouts.admin')
@section('content')
    <h1 class="mt-4"></h1>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>{{$pageTitle}}</div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                $userObj = new \App\User();
                $loggedinUserTypeId = $userObj->getLoggedinUserTypeId();
                ?>
                <table class="w-100 table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Invoice No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Assessment Year</th>
                        <th scope="col">Payment Status</th>
                        @if(in_array($loggedinUserTypeId, array(1)))
                            <th scope="col">User</th>
                        @endif
                        <th scope="col" style="width: 300px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($assessmentList))
                        <?php
                        $paymentObj = new \App\Payment();
                        $count = 1;
                        $inv = '';
                        ?>
                        @foreach($assessmentList as $assessment)
                            <?php
                            $assessmentId = !empty($assessment->id) ? intval($assessment->id) : 0;
                            $userId = !empty($assessment->user_id) ? intval($assessment->user_id) : 0;
                            $userName = !empty($assessment->user_name) ? ucwords($assessment->user_name) : '';
                            $customerName = !empty($assessment->customer_name) ? $assessment->customer_name : '';
                            $customerCode = !empty($assessment->customer_code) ? $assessment->customer_code : '';
                            $assessmentYear = !empty($assessment->assessment_year) ? ($assessment->assessment_year) : '';
                            $invoiceNo = !empty($assessment->invoice_no) ? ($assessment->invoice_no) : '';
                            $inv = (!empty($assessmentYear) ? str_replace("-", "", $assessmentYear) : '') . $invoiceNo;
                            $paymentInfo = $paymentObj->getPaymentByAssessmentId($assessmentId);
                            $spCode = !empty($paymentInfo->sp_code) ? ($paymentInfo->sp_code) : '';
                            $transactionAmount = !empty($paymentInfo->transaction_amount) ? doubleval($paymentInfo->transaction_amount) : 0;
                            if ($transactionAmount == doubleval('575')) {
                                $transactionAmountText = 'Paid';
                                $transactionAmountTextColor = 'success';
                            } elseif ($transactionAmount == getArrayValueByKey(1, getPaymentPlanWiseAmount())) {
                                $transactionAmountText = 'Paid';
                                $transactionAmountTextColor = 'warning';
                            } elseif ($transactionAmount == getArrayValueByKey(2, getPaymentPlanWiseAmount())) {
                                $transactionAmountText = 'Paid';
                                $transactionAmountTextColor = 'primary';
                            } else {
                                $transactionAmountText = 'Not Paid';
                                $transactionAmountTextColor = 'danger';
                            }
                            if ($spCode != '000') {
                                $transactionAmountText = 'Not Paid';
                                $transactionAmountTextColor = 'danger';
                            }
                            ?>
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $inv }}</td>
                                <td>{{ $customerName }}<br/><small>Tracking
                                        ID:{{ $customerCode }}</small></td>
                                <td>{{ $assessmentYear }}</td>
                                <td><span style="display:inline-block; width:60px;"
                                          class="badge badge-{{ $transactionAmountTextColor }}">{{ $transactionAmountText }}</span>
                                </td>
                                @if(in_array($loggedinUserTypeId, array(1)))
                                    <td>{{ $userName }}</td>
                                @endif
                                <td class="">
                                    <a href="{{ route('adminAssessmentByAssessmentYear') }}"
                                       data-id="{{ $assessmentId }}" type="button"
                                       class="btn btn-secondary viewDetailsButton" data-toggle="tooltip"
                                       data-placement="bottom" title="View Details">View&nbsp;<i class="fa fa-eye-slash"
                                                                                                 aria-hidden="true"></i></a>
                                    <a href="{{route('adminAssessmentGenerateToPdf', ['id' => $assessmentId])}}"
                                       target="_blank"
                                       data-id="{{ $assessmentId }}" type="button"
                                       class="btn btn-secondary generatePdfButton1" data-toggle="tooltip"
                                       data-placement="bottom" title="Print">Print&nbsp;<i class="fa fa-print"
                                                                                           aria-hidden="true"></i></a>
                                    @if(in_array($loggedinUserTypeId, array(1, 2, 3)))
                                        <a href="{{route('adminAssessmentEdit', ['id' => $assessmentId])}}"
                                           target="_blank"
                                           data-id="{{ $assessmentId }}" type="button"
                                           class="btn btn-secondary" data-toggle="tooltip"
                                           data-placement="bottom" title="Update">Edit&nbsp;<i class="fa fa-edit"
                                                                                               aria-hidden="true"></i></a>
                                    @endif
                                    <div class="viewAssessmentDetailsModalSection"></div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $('.viewDetailsButton').unbind("click").bind('click', function (e) {
            e.preventDefault();
            {{--var baseUrl = {!! json_encode(url('/')) !!};--}}
            // var url = baseUrl + '/getTaxInterestAmount';
            var id = 0;
            var thisButton = $(this);
            id = thisButton.attr('data-id');
            id = (id == '' || isNaN(id)) ? 0 : parseInt(id);
            if (id > 0) {
                $.ajax({
                    type: "GET",
                    url: thisButton.attr('href'),
                    data: {'id': id},
                    beforeSend: function () {
                        $('.viewDetailsButton').addClass('disabled');
                    },
                    complete: function () {
                        $('.viewDetailsButton').removeClass('disabled');
                    },
                    success: function (data) {
                        $('.viewAssessmentDetailsModalSection').html('');
                        $('.viewAssessmentDetailsModalSection').html(data);
                        $('#assessmentDetailsModal').modal('show');
                    },
                    error: function () {

                    },
                });
            } else {
                alert('Error Occurred.');
                return false;
            }
        });

        $('.generatePdfButton').click(function (e) {
            e.preventDefault();
            {{--var baseUrl = {!! json_encode(url('/')) !!};--}}
            // var url = baseUrl + '/getTaxInterestAmount';
            var id = 0;
            var thisButton = $(this);
            id = thisButton.attr('data-id');
            id = (id == '' || isNaN(id)) ? 0 : parseInt(id);
            if (id > 0) {
                $.ajax({
                    type: "GET",
                    url: thisButton.attr('href'),
                    data: {'id': id},
                    beforeSend: function () {
                        $('.generatePdfButton').addClass('disabled');
                    },
                    complete: function () {
                        $('.generatePdfButton').removeClass('disabled');
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function () {

                    }
                });
            } else {
                alert('Error Occurred.');
                return false;
            }
        });
    </script>
@endsection
