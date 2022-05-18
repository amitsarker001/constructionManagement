<?php
/**
 * Created By: Amit Sarker
 * Created Date: 05-10-2020
 */
?>
@extends('admin.layouts.admin')
@section('content')
    <h1 class="mt-4">{{$pageTitle}}</h1>
    <div class="w-100">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="addCostActionForm" name="addCostActionForm" class="addCostActionForm" method="POST" action="{{route('addDetailsToTable')}}">
            @include('admin.cost.formFields')
        </form>
        <form id="saveCostActionForm" name="saveCostActionForm" class="saveCostActionForm" method="POST" action="{{route('costSave')}}">
        {{csrf_field()}}
        <div class="form-row">
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="step_id">Step Name</label>
        <select class="form-control" id="step_id" name="step_id" required>
                <option value="">Please select</option>
                <?php $step_id = !empty($costInfo->step_id) ? $costInfo->step_id : 0; ?>
                @if(!empty($stepList))
                    @foreach($stepList as $step)
                        <option value="{{$step->id}}" {{($step_id == $step->id) ? 'selected' : ''}}>{{$step->step_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group"><label class="small mb-1" for="entry_date">Entry Date</label><input
                class="form-control" id="entry_date" name="entry_date" type="date" placeholder="Date"
                value="{{!empty($costInfo->entry_date) ?$costInfo->entry_date : ''}}">
        </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
            <button style="margin-top: 7%;" id="" class="btn btn-info"><i class="" aria-hidden="true"></i>Save</button>
        </div>
    </div>
</div>
        </form>
    </div>
    <script type="text/javascript">

        addActionFormACtion();

        function addActionFormACtion() {
            $('#addCostActionForm').validate({
                rules: {
                    cost_name: "required",
                    unit: "required",
                },
                messages: {
                    cost_name: "Please Enter Name",
                    unit: "Please Select Unit",
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
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".error-message").addClass("has-error").removeClass("has-success");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".error-message").addClass("has-success").removeClass("has-error");
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        }

        addPurchaseOrderInTable();
        function addPurchaseOrderInTable() {
            var thisForm = $('.addCostActionForm');
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
                            console.log(data);
                        },
                        error: function () {

                        }
                    });
                }
            });
        }
    </script>
@endsection
