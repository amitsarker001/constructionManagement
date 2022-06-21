<?php
/**
 * Created By: Amit Sarker
 * Created Date: 05-10-2020
 */
?>

<div id="reportTableSection" class="w-100 report-table">
    <div>
        <h3><span
                class="font-weight-bold">Item:</span> {{!empty($data['itemInfo']) ? $data['itemInfo']->item_name : ''}}
        </h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>SL</th>
                <th>Item Name</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Standard Rate</th>
                <th>Standard Amount</th>
                <th>Increase Rate</th>
                <th>Increase Amount</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $count = 1;
            $quantitySum = 0;
            $rateSum = 0;
            $amountSum = 0;
            $standardRateSum = 0;
            $standardAmountSum = 0;
            $increaseRateSum = 0;
            $increaseAmountSum = 0;
            $itemwiseReport = !empty($data['itemwiseReport']) ? $data['itemwiseReport'] : '';
            ?>
            @if(!empty($itemwiseReport))
                @foreach($itemwiseReport as $report)
                    <?php
                    $itemName = !empty($report->item_name) ? ($report->item_name) : '';
                    $supplierName = !empty($report->supplier_name) ? ($report->supplier_name) : '';
                    $quantity = !empty($report->quantity) ? ($report->quantity) : 0;
                    $rate = !empty($report->rate) ? ($report->rate) : 0;
                    $amount = !empty($report->amount) ? ($report->amount) : 0;
                    $standardRate = !empty($report->standard_rate) ? ($report->standard_rate) : 0;
                    $standardAmount = !empty($report->standard_amount) ? ($report->standard_amount) : 0;
                    $increaseRate = !empty($report->increase_rate) ? ($report->increase_rate) : 0;
                    $increaseAmount = !empty($report->increase_amount) ? ($report->increase_amount) : 0;
                    $quantitySum += $quantity;
                    $rateSum += $rate;
                    $amountSum += $amount;
                    $standardRateSum += $standardRate;
                    $standardAmountSum += $standardAmount;
                    $increaseRateSum += $increaseRate;
                    $increaseAmountSum += $increaseAmount;
                    ?>
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td class="text-right">{{ $itemName }}</td>
                        <td class="text-right">{{ $supplierName }}</td>
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
                <td colspan="3" class="font-weight-bold text-right">Total</td>
                <td class="font-weight-bold text-right">{{ getFloat($quantitySum) }}</td>
                <td class="font-weight-bold text-right">{{ getFloat($rateSum) }}</td>
                <td class="font-weight-bold text-right">{{ getFloat($amountSum) }}</td>
                <td class="font-weight-bold text-right">{{ getFloat($standardRateSum) }}</td>
                <td class="font-weight-bold text-right">{{ getFloat($standardAmountSum) }}</td>
                <td class="font-weight-bold text-right">{{  getFloat($increaseRateSum) }}</td>
                <td class="font-weight-bold text-right">{{  getFloat($increaseAmountSum) }}</td>
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
            Item wise Details Report
        </div>
        <hr>
        <div>
            <h3><span
                    class="font-weight-bold">Item:</span> {{!empty($data['itemInfo']) ? $data['itemInfo']->item_name : ''}}
            </h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Item Name</th>
                    <th>Supplier</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Standard Rate</th>
                    <th>Standard Amount</th>
                    <th>Increase Rate</th>
                    <th>Increase Amount</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                $quantitySum = 0;
                $rateSum = 0;
                $amountSum = 0;
                $standardRateSum = 0;
                $standardAmountSum = 0;
                $increaseRateSum = 0;
                $increaseAmountSum = 0;
                $itemwiseReport = !empty($data['itemwiseReport']) ? $data['itemwiseReport'] : '';
                ?>
                @if(!empty($itemwiseReport))
                    @foreach($itemwiseReport as $report)
                        <?php
                        $itemName = !empty($report->item_name) ? ($report->item_name) : '';
                        $supplierName = !empty($report->supplier_name) ? ($report->supplier_name) : '';
                        $quantity = !empty($report->quantity) ? ($report->quantity) : 0;
                        $rate = !empty($report->rate) ? ($report->rate) : 0;
                        $amount = !empty($report->amount) ? ($report->amount) : 0;
                        $standardRate = !empty($report->standard_rate) ? ($report->standard_rate) : 0;
                        $standardAmount = !empty($report->standard_amount) ? ($report->standard_amount) : 0;
                        $increaseRate = !empty($report->increase_rate) ? ($report->increase_rate) : 0;
                        $increaseAmount = !empty($report->increase_amount) ? ($report->increase_amount) : 0;
                        $quantitySum += $quantity;
                        $rateSum += $rate;
                        $amountSum += $amount;
                        $standardRateSum += $standardRate;
                        $standardAmountSum += $standardAmount;
                        $increaseRateSum += $increaseRate;
                        $increaseAmountSum += $increaseAmount;
                        ?>
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td class="text-right">{{ $itemName }}</td>
                            <td class="text-right">{{ $supplierName }}</td>
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
                    <td colspan="3" class="font-weight-bold text-right">Total</td>
                    <td class="font-weight-bold text-right">{{ getFloat($quantitySum) }}</td>
                    <td class="font-weight-bold text-right">{{ getFloat($rateSum) }}</td>
                    <td class="font-weight-bold text-right">{{ getFloat($amountSum) }}</td>
                    <td class="font-weight-bold text-right">{{ getFloat($standardRateSum) }}</td>
                    <td class="font-weight-bold text-right">{{ getFloat($standardAmountSum) }}</td>
                    <td class="font-weight-bold text-right">{{  getFloat($increaseRateSum) }}</td>
                    <td class="font-weight-bold text-right">{{  getFloat($increaseAmountSum) }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    itemwiseReportShow();

    function itemwiseReportShow() {
        var thisForm = $('#reportForm');
        thisForm.validate({
            ignore: [],
            rules: {
                item_id: "required",
            },
            messages: {
                item_id: "This field is required.",
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
