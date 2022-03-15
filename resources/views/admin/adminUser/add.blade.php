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
        <form id="addUserActionForm" name="" class="" method="POST" action="{{route('adminUserSave')}}">
            @include('admin.adminUser.formFields')
        </form>
    </div>
    <script type="text/javascript">

        addUserActionFormACtion();

        function addUserActionFormACtion() {
            $('#addUserActionForm').validate({
                rules: {
                    user_name: "required",
                    user_type_id: "required",
                    address: "required",
                    is_active: "required",
                    mobile: {
                        required: true,
                        // number: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5,
                    },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: '#password',
                    }
                },
                messages: {
                    user_name: "Please Enter Name",
                    user_type_id: "Please Select User type",
                    address: "Please Enter Address",
                    is_active: "Please Select Status",
                    mobile: {
                        required: "Please Enter Mobile Number",
                        // number: "Please Enter a valid mobile number",
                    },
                    email: {
                        required: "Please Enter Email Address",
                        email: "Please Enter a Valid Email Address",
                    },
                    password: {
                        required: "Please Enter a password",
                        minlength: "Password must be at least 5 characters long",
                    },
                    confirm_password: {
                        required: "Please Enter a confirm password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Password doest not match",
                    }
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
