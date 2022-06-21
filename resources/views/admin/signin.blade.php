<?php
/**
 * Created By: Amit Sarker
 * Created Date: 19-09-2020
 */
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    @section('title')
        {{getCompanyName() . ' | Admin'}}
    @endsection
    @include('admin.includes.head')
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">
                                    <strong>Login</strong></h3>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{{ Session::get('success') }}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::get('error'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ Session::get('error') }}</li>
                                        </ul>
                                    </div>
                                @endif
                                <form id="signinForm" class="form" action="{{route('adminLogin')}}" method="post"
                                      enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group"><label class="small mb-1"
                                                                   for="inputEmailAddress"><strong>Email</strong></label><input
                                            class="form-control py-4" id="inputEmailAddress" type="email" name="email"
                                            required value="halim@gmail.com"
                                            placeholder="Enter email address"/></div>
                                    <div class="form-group"><label class="small mb-1"
                                                                   for="inputPassword"><strong>Password</strong></label><input
                                            class="form-control py-4" id="inputPassword" type="password" name="password"
                                            required value="123456"
                                            placeholder="Enter password"/></div>
                                    <div class="form-group d-none">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input"
                                                                                           id="rememberPasswordCheck"
                                                                                           type="checkbox"/><label
                                                class="custom-control-label" for="rememberPasswordCheck">Remember
                                                password</label></div>
                                    </div>
                                    <div
                                        class="form-group d-flex align-items-center justify-content-between mt-4 mb-0 float-right">
                                        <a class="small d-none" href="#">Forgot Password?</a>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center d-none">
                                <div class="small"><a href="#">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            @include('admin.includes.footer')
        </footer>
    </div>
</div>
@include('admin.includes.script')
<script type="text/javascript">

    signinFormACtion();

    function signinFormACtion() {
        $('#signinForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "Please Enter Your Email",
                    email: "Please Enter Valid Email",
                },
                password: {
                    required: "Please Enter your Password",
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
</body>
</html>

