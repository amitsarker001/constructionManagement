<?php
/**
 * Created By: Amit Sarker
 * Created Date: 28-08-2020
 */
?>

<div id="costDetailsModal" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $data['pageTitle'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div id="" class="w-100">
                    <?php
                    //echo '<pre>';
                    //print_r($data);
                    ?>
                    <div id="costInfoSection">
                        <div class="row">
                            <label for="entry_date" class="col-sm-2 col-form-label font-weight-bold">Date:</label>
                            <div class="col-sm-10">
                                <label for="entry_date"
                                       class="col-sm-10 col-form-label">{{ !empty($data['costInfo']->entry_date) ? getStringToDateFromatDmy($data['costInfo']->entry_date) : '' }}</label>
                            </div>
                        </div>

                        <div class="row">
                            <label for="entry_date" class="col-sm-2 col-form-label font-weight-bold">Step:</label>
                            <div class="col-sm-10">
                                <label for="entry_date"
                                       class="col-sm-10 col-form-label">{{ !empty($data['stepInfo']->step_name) ? $data['stepInfo']->step_name : '' }}</label>
                            </div>
                        </div>
                    </div>
                    <div id="costDetailsSection">
                        <?php
                        $costDetails = !empty($data['costDetails']) ? $data['costDetails'] : '';
                        ?>
                        @if(!empty($costDetails))
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Particulars</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Standard Rate</th>
                                    <th>Standard Amount</th>
                                    <th>Increase Rate (%)</th>
                                    <th>Increase Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                $amountSum = 0;
                                $increaseAmountSum = 0;
                                ?>
                                @if(!empty($costDetails))
                                    @foreach($costDetails as $cost)
                                        <?php
                                        $itemObj = new \App\Item();
                                        $itemId = !empty($cost->item_id) ? ($cost->item_id) : 0;
                                        $itemInfo = $itemObj->getById($itemId);
                                        $itemName = !empty($itemInfo->item_name) ? $itemInfo->item_name : '';

                                        $quantity = !empty($cost->quantity) ? ($cost->quantity) : 0;
                                        $rate = !empty($cost->rate) ? ($cost->rate) : 0;
                                        $amount = !empty($cost->amount) ? ($cost->amount) : 0;
                                        $standardRate = !empty($cost->standard_rate) ? ($cost->standard_rate) : 0;
                                        $standardAmount = !empty($cost->standard_amount) ? ($cost->standard_amount) : 0;
                                        $increaseRate = !empty($cost->increase_rate) ? ($cost->increase_rate) : 0;
                                        $increaseAmount = !empty($cost->increase_amount) ? ($cost->increase_amount) : 0;
                                        $amountSum += $amount;
                                        $increaseAmountSum += $increaseAmount;
                                        ?>
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td class="text-right">{{ $itemName }}</td>
                                            <td class="text-right">{{ getFloat($quantity) }}</td>
                                            <td class="text-right">{{ getFloat($rate) }}</td>
                                            <td class="text-right">{{ getFloat($amount) }}</td>
                                            <td class="text-right">{{ getFloat($standardRate) }}</td>
                                            <td class="text-right">{{ getFloat($standardAmount) }}</td>
                                            <td class="text-right">{{ getFloat($increaseRate) }}</td>
                                            <td class="text-right">{{ getFloat($increaseAmount) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" class="font-weight-bold text-right">Total</td>
                                    <td class="font-weight-bold text-right">{{  getFloat($amountSum)  }}</td>
                                    <td class="font-weight-bold text-right"></td>
                                    <td class="font-weight-bold text-right"></td>
                                    <td class="font-weight-bold text-right"></td>
                                    <td class="font-weight-bold text-right">{{  getFloat($increaseAmountSum)  }}</td>
                                </tr>
                                </tfoot>
                            </table>

                        @else
                            <div>No Data Found</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="printButton" type="button" class="btn btn-info"><i class="fa fa-print"
                                                                               aria-hidden="true"></i> Print
                </button>
                <button id="closeButton" type="button" class="btn btn-danger" data-dismiss="modal"><i
                        class="fa fa-times" aria-hidden="true"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<div id="DivIdToPrint" class="w-100 d-none" style="width: 100%;">
    <style>
        .costDetailsSectionTable, th, td {
            border: 1px solid;
        }

        .text-right {
            text-align: right !important;
        }

        .font-weight-bold {
            font-weight: bold;
        }
    </style>
    <div id="costInfoSection">
        <div class="row" style="margin-top: 2%; margin-bottom: 2%;">
            <label style="float: left; width: 10%" for="entry_date" class="col-sm-2 col-form-label">Date:</label>
            <div class="col-sm-10" style="float: left; width: 90%">
                <label for="entry_date"
                       class="col-sm-10 col-form-label">{{ !empty($data['costInfo']->entry_date) ? getStringToDateFromatDmy($data['costInfo']->entry_date) : '' }}</label>
            </div>
        </div>

        <div class="row" style="margin-top: 2%; margin-bottom: 2%;">
            <label style="float: left; width: 10%" for="entry_date" class="col-sm-2 col-form-label">Step:</label>
            <div class="col-sm-10" style="float: left; width: 90%">
                <label for="step_name"
                       class="col-sm-10 col-form-label">{{ !empty($data['stepInfo']->step_name) ? $data['stepInfo']->step_name : '' }}</label>
            </div>
        </div>
    </div>
    <div id="costDetailsSection">
        <div class="font-weight-bold" style="margin-top: 5%;">Details</div>
        <hr>
        <?php
        $costDetails = !empty($data['costDetails']) ? $data['costDetails'] : '';
        ?>
        @if(!empty($costDetails))
            <table class="table costDetailsSectionTable" id="" width="100%" cellspacing="0"
                   style="border: 1px solid black; width: 100%; border-collapse: collapse;">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Particulars</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Standard Rate</th>
                    <th>Standard Amount</th>
                    <th>Increase Rate (%)</th>
                    <th>Increase Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                $amountSum = 0;
                $increaseAmountSum = 0;
                ?>
                @if(!empty($costDetails))
                    @foreach($costDetails as $cost)
                        <?php
                        $itemObj = new \App\Item();
                        $itemId = !empty($cost->item_id) ? ($cost->item_id) : 0;
                        $itemInfo = $itemObj->getById($itemId);
                        $itemName = !empty($itemInfo->item_name) ? $itemInfo->item_name : '';

                        $quantity = !empty($cost->quantity) ? ($cost->quantity) : 0;
                        $rate = !empty($cost->rate) ? ($cost->rate) : 0;
                        $amount = !empty($cost->amount) ? ($cost->amount) : 0;
                        $standardRate = !empty($cost->standard_rate) ? ($cost->standard_rate) : 0;
                        $standardAmount = !empty($cost->standard_amount) ? ($cost->standard_amount) : 0;
                        $increaseRate = !empty($cost->increase_rate) ? ($cost->increase_rate) : 0;
                        $increaseAmount = !empty($cost->increase_amount) ? ($cost->increase_amount) : 0;
                        $amountSum += $amount;
                        $increaseAmountSum += $increaseAmount;
                        ?>
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td class="text-right">{{ $itemName }}</td>
                            <td class="text-right">{{ getFloat($quantity) }}</td>
                            <td class="text-right">{{ getFloat($rate) }}</td>
                            <td class="text-right">{{ getFloat($amount) }}</td>
                            <td class="text-right">{{ getFloat($standardRate) }}</td>
                            <td class="text-right">{{ getFloat($standardAmount) }}</td>
                            <td class="text-right">{{ getFloat($increaseRate) }}</td>
                            <td class="text-right">{{ getFloat($increaseAmount) }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" class="font-weight-bold text-right">Total</td>
                    <td class="font-weight-bold text-right">{{  getFloat($amountSum)  }}</td>
                    <td class="font-weight-bold text-right"></td>
                    <td class="font-weight-bold text-right"></td>
                    <td class="font-weight-bold text-right"></td>
                    <td class="font-weight-bold text-right">{{  getFloat($increaseAmountSum)  }}</td>
                </tr>
                </tfoot>
            </table>

        @else
            <div>No Data Found</div>
        @endif
    </div>
</div>

<script type="text/javascript">

    $('#printButton').click(function (e) {
        e.preventDefault();
        printDivById('DivIdToPrint')
    });

    function printDiv(className) {
        var divContents = $('.' + className).html();
        var printWindow = window.open();
        printWindow.document.write(divContents);
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    }

    function printDivById(divId) {
        var divContents = $('#' + divId).html();
        var printWindow = window.open();
        printWindow.document.write(divContents);
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    }
</script>
