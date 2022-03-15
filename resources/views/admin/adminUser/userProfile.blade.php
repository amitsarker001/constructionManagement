<?php
/**
 * Created By: Amit Sarker
 * Created Date: 07-10-2020
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
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('warning'))
            <div class="alert alert-warning alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form id="myProfileForm" name="" class="" method="POST" action="{{route('adminUserProfileUpdateAction')}}">
            {{csrf_field()}}
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group"><label class="small mb-1" for="userName">Name</label><input
                            class="form-control" id="userName" name="user_name" type="text" placeholder="Name"
                            value="{{!empty($userInfo->user_name) ?$userInfo->user_name : ''}}" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group"><label class="small mb-1" for="mobile">Mobile</label><input
                            class="form-control" id="mobile" name="mobile" type="text"
                            placeholder="Mobile" value="{{!empty($userInfo->mobile) ?$userInfo->mobile : ''}}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label class="small mb-1" for="email">Email</label><input
                            class="form-control" id="email" name="email" type="email" placeholder="Email"
                            value="{{!empty($userInfo->email) ?$userInfo->email : ''}}" required readonly>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group"><label class="small mb-1" for="password">Password</label><input
                            class="form-control" id="password" name="password" type="password"
                            placeholder="Enter password" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group"><label class="small mb-1" for="confirmPassword">Confirm
                            Password</label><input class="form-control" id="confirmPassword"
                                                   name="confirm_password" type="password"
                                                   placeholder="Confirm password" required>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                    <div class="form-group"><label class="small mb-1" for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2"
                                  required>{{!empty($userInfo->address) ?$userInfo->address : ''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group mt-4 mb-0">
                <button id="" class="btn btn-primary">{{!empty($buttonText) ? $buttonText : 'Save'}}</button>
            </div>

        </form>
    </div>
    <script type="text/javascript">

        myProfileFormAction();

        function myProfileFormAction() {
            $('#myProfileForm').validate({
                rules: {
                    user_name: "required",
                    address: "required",
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
                    address: "Please Enter Address",
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
