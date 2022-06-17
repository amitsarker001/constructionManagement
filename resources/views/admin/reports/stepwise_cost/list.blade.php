<?php
/**
 * Created By: Amit Sarker
 * Created Date: 05-10-2020
 */
?>

<div id="reportTableSection" class="w-100 report-table">
    <div>
        <h3><span
                class="font-weight-bold">Step:</span> {{!empty($data['stepInfo']) ? $data['stepInfo']->step_name : ''}}
        </h3>
    </div>
    <div class="table-responsive">
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
            $stepwiseReport = !empty($data['stepwiseReport']) ? $data['stepwiseReport'] : '';
            ?>
            @if(!empty($stepwiseReport))
                @foreach($stepwiseReport as $cost)
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
    </div>
</div>

<div id="DivIdToPrint" style="display: none;">
    <style>
        .print-table, th, td {
            border: 1px solid;
        }

        .text-right {
            text-align: right !important;
        }

        .font-weight-bold {
            font-weight: bold;
        }
    </style>
    <div id="" class="w-100">
        <div class="font-weight-bold">
            Stepwise Details Report
        </div>
        <hr>
        <div>
            <h3><span
                    class="font-weight-bold">Step:</span> {{!empty($data['stepInfo']) ? $data['stepInfo']->step_name : ''}}
            </h3>
        </div>
        <div class="table-responsive">
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
                $stepwiseReport = !empty($data['stepwiseReport']) ? $data['stepwiseReport'] : '';
                ?>
                @if(!empty($stepwiseReport))
                    @foreach($stepwiseReport as $cost)
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
        </div>
    </div>
</div>

<script type="text/javascript">
    supplierwiseReportShow();

    function supplierwiseReportShow() {
        var thisForm = $('#supplierwiseReportForm');
        thisForm.validate({
            ignore: [],
            rules: {
                supplier_id: "required",
                status: "required",
            },
            messages: {
                item_id: "Please Select Supplier",
                status: "Please Select Status",
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
                if (element.attr("name") === "item_id") {
                    error.insertAfter(".bootstrap-select.item_id");
                } else {
                    error.insertAfter(element);
                }
                if (element.attr("name") === "item_id") {
                    error.insertAfter(".select2-selection #select2-item_id-container");
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".error-message").addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".error-message").addClass("has-success").removeClass("has-error");
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: thisForm.attr('action'),
                    data: thisForm.serialize(),
                    success: function (data) {
                        $('#reportTableSection').html(data);
                    },
                    error: function () {

                    }
                });
            }
        });
    }

    $('#printButton').click(function (e) {
        e.preventDefault();
        printDivById('DivIdToPrint')
    });

</script>
