<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
 */
?>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{csrf_field()}}
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="item_id">Item Name</label>
            <select class="form-control" id="item_id" name="item_id" required>
                <option value="">Please select</option>
                <?php $item_id = !empty($costInfo->item_id) ? $costInfo->item_id : 0; ?>
                @if(!empty($itemList))
                    @foreach($itemList as $item)
                        <option
                            value="{{$item->id}}" {{($item_id == $item->id) ? 'selected' : ''}}>{{$item->item_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="quantity">Quantity</label><input
                class="form-control" id="quantity" name="quantity" type="number"
                placeholder="Quantity" value="{{!empty($costInfo->quantity) ?getFloat($costInfo->quantity) : ''}}"
                required></div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="rate">Rate</label>
            <input readonly class="form-control" id="rate" name="rate" type="number"
                   placeholder="Rate" value="{{!empty($costInfo->rate) ?getFloat($costInfo->rate) : ''}}"
                   required></div>
    </div>
</div>
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="amount">Amount</label><input
                class="form-control" id="amount" name="amount" type="number"
                placeholder="Amount" value="{{!empty($costInfo->amount) ?getFloat($costInfo->amount) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="standard_rate">Standard Rate</label>
            <input
                class="form-control" id="standard_rate" name="standard_rate" type="number"
                placeholder="Standard Rate"
                value="{{!empty($costInfo->standard_rate) ?getFloat($costInfo->standard_rate) : ''}}"
                required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="standard_amount">Standard Amount</label>
            <input readonly class="form-control" id="standard_amount" name="standard_amount" type="number"
                   placeholder="Standard Amount"
                   value="{{!empty($costInfo->standard_amount) ?getFloat($costInfo->standard_amount) : ''}}"
                   required>
        </div>
    </div>
</div>
<div class="form-row">

</div>
<div class="form-row">
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="increase_rate">Increase Rate (%)</label>
            <input readonly class="form-control" id="increase_rate" name="increase_rate" type="number"
                   placeholder="Increase Rate"
                   value="{{!empty($costInfo->increase_rate) ?getFloat($costInfo->increase_rate) : ''}}"
                   required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="increase_amount">Increase Amount</label>
            <input readonly class="form-control" id="increase_amount" name="increase_amount" type="number"
                   placeholder="Increase Amount"
                   value="{{!empty($costInfo->increase_amount) ?getFloat($costInfo->increase_amount) : ''}}"
                   required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <button data-action="{{route('addDetailsToTable')}}" type="submit"
                    style="margin-top: 7%;" id="" class="btn btn-secondary addDetailsButton"><i class="fa fa-plus"
                                                                               aria-hidden="true"></i> Add
            </button>
            <a style="margin-top: 7%;" class="btn btn-danger float-right" href="{{route('clearDetailsFromTable')}}"><i
                    class="fa fa-trash" aria-hidden="true"></i> Clear Table</a>

        </div>
    </div>
</div>

<div id="detailsTableSection">
    @include('admin.cost.detailsTable')
</div>

<script type="text/javascript">

    addInTable();
    function addInTable() {
        var thisForm = $('#addCostActionForm');
        thisForm.validate({
            ignore: [],
            rules: {
                item_id: "required",
                quantity: {
                    required: true,
                    number: true,
                },
                amount: {
                    required: true,
                    number: true,
                    min: 0.01,
                },
            },
            messages: {
                item_id: "Please Select Item",
                quantity: {
                    required: "Please Enter Quantity",
                    number: "Please Enter a valid quantity",
                },
                amount: {
                    required: "Please Enter Amount",
                    number: "Please Enter a valid Amount",
                    min: "Please Enter a valid Amount greater than 0.",
                },
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
                        $('#detailsTableSection').html(data);
                    },
                    error: function () {

                    }
                });
            }
        });
    }

    $('#quantity, #amount, #standard_rate, #standard_rate').keyup(function (e) {
        e.preventDefault();
        getRate();
        getStandardAmount();
        getIncreaseRate();
        getIncreaseAmount();
    });

    function getRate() {
        let rate = 0;
        let quantity = parseFloat($('#quantity').val());
        let amount = parseFloat($('#amount').val());
        if (quantity > 0) {
            rate = (amount / quantity);
        }
        $('#rate').val(rate.toFixed(2));
    }

    function getStandardAmount() {
        let standardAmount = 0;
        let quantity = parseFloat($('#quantity').val());
        let standardRate = parseFloat($('#standard_rate').val());
        if (quantity > 0) {
            standardAmount = (quantity * standardRate);
        }
        $('#standard_amount').val(standardAmount.toFixed(2));
    }

    function getIncreaseRate() {
        let increaseRate = 0;
        let rate = parseFloat($('#rate').val());
        let StandardRate = parseFloat($('#standard_rate').val());
        if (StandardRate > 0) {
            increaseRate = ((rate / StandardRate) * 100);
        }
        $('#increase_rate').val(increaseRate.toFixed(2));
    }

    function getIncreaseAmount() {
        let increaseAmount = 0;
        let amount = parseFloat($('#amount').val());
        let standardAmount = parseFloat($('#standard_amount').val());
        // if (StandardRate > 0) {
        increaseAmount = (amount - standardAmount);
        // }
        $('#increase_amount').val(increaseAmount.toFixed(2));
    }
</script>

