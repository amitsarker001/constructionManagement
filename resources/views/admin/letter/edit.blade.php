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
        <form id="editLetterActionForm" name="" class="" method="POST" action="{{route('letterUpdate')}}">
            <input type="hidden" id="id" name="id" value="{{!empty($letterInfo->id) ? intval($letterInfo->id) : 0}}">
            @include('admin.letter.formFields')
        </form>
    </div>
    <script type="text/javascript">

        editLetterActionFormACtion();

        function editLetterActionFormACtion() {
            $('#editLetterActionForm').validate({
                rules: {
                    supplier_id: "required",
                    entry_date: "required",
                    subject: "required",
                    description: "required",
                },
                messages: {
                    supplier_id: "Please Enter",
                    entry_date: "Please Select",
                    subject: "Please Enter",
                    description: "Please Enter",
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
