<?php
/**
 * Created By: Amit Sarker
 * Created Date: 06-10-2020
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
        <form id="editBudgetActionForm" name="" class="" method="POST" action="{{route('budgetUpdate')}}">
            <input type="hidden" id="id" name="id" value="{{!empty($budgetInfo->id) ? intval($budgetInfo->id) : 0}}">
            @include('admin.budget.formFields')
        </form>
    </div>
    <script type="text/javascript">

        editActionFormACtion();

        function editActionFormACtion() {
            $('#editBudgetActionForm').validate({
                rules: {
                    cash_amount: "required",
                    extra_amount_claimed: "required",
                    total_allocated_funds: "required",
                    funds_remaining: "required",
                    entry_date: "required",
                },
                messages: {
                    // cash_amount: "Please Enter Amount",
                    // extra_amount_claimed: "Please Enter Amount",
                    // total_allocated_funds: "Please Enter Amount",
                    // funds_remaining: "Please Enter Amount",
                    // entry_date: "Please select Date"
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
    </script>
@endsection
