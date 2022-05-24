<?php
/**
 * Created By: Amit Sarker
 * Created Date: 05-10-2020
 */
?>

<div id="reportTableSection" class="w-100 report-table">
    <div class="table-responsive">
        <table class="table table-bordered" id="" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>SL</th>
                <th>Supplier</th>
                <th>Step</th>
                <th>Item</th>
                <th>Status</th>
                <th>Notes</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $costSummaryReport = !empty($data['costSummaryReport']) ? $data['costSummaryReport'] : '';
            ?>
            @if(!empty($supplierwiseReport))
                <?php $count = 1; ?>
                @foreach($supplierwiseReport as $report)
                    <?php
                    $supplierName = !empty($report->supplier_name) ? ($report->supplier_name) : '';
                    $stepName = !empty($report->step_name) ? ($report->step_name) : '';
                    $itemName = !empty($report->item_name) ? ($report->item_name) : '';
                    $status = !empty($report->status) ? ($report->status) : '';
                    $notes = !empty($report->notes) ? ($report->notes) : '';
                    ?>
                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$supplierName}}</td>
                        <td>{{$stepName}}</td>
                        <td>{{$itemName}}</td>
                        <td>{{$status}}</td>
                        <td>{{$notes}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
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
</script>
