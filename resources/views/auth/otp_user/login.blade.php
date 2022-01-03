<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; GB</title>
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <!-- CSS Libraries -->
    {{-- <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css"> --}}
    
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <style>
        .cm-form-control {
            -webkit-transition: none;
            transition: none;
            width: 2.4rem;
            height: 2.4rem !important;
            padding-left: 0px !important;
            padding-right: 0px !important;
            font-size: 16px !important;
            text-align: center;
            transition: width .5s, color 0.15s ease, background-color 0.15s ease, border-color 0.15s ease, box-shadow 0.15s ease;
        }
        @media (min-width: 452px) {
            .cm-form-control {
                width: 3rem;
                height: 3rem !important;
            }
        }
        @media (min-width: 576px) {
            .cm-form-control {
                width: 3rem;
                height: 3rem !important;
            }
        }
        @media (min-width: 992px) {
            .cm-form-control {
                width: 4rem;
                height: 4rem !important;
            }
        }
        
        .form-control.is-valid, .was-validated .form-control:valid {
            background-image: none;
        }
        .form-control.is-invalid, .was-validated .form-control:invalid {
            background-image: none;
        }
        
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 col-lg-8 col-xl-6 mx-auto">
                        @error('otp_code')
                        <div class="alert alert-danger">
                            Invalid Access Code!
                        </div>
                        @enderror
                        <div class="card card-primary">
                            <div class="card-header justify-content-center">
                                <img src="{{ asset('assets/img/logo-dark.png') }}" alt="logo gantari" width="300px">
                            </div>
                            
                            <div class="card-body">
                                <form method="POST" action="{{ route('otp_user.login', ['token' => $token_user]) }}" class="needs-validation" novalidate="">
                                    @csrf
                                    <input hidden id="otp" name="otp" value="">
                                    <div class="form-group">
                                        <div id="OTPInput" class="d-flex justify-content-center">
                                            <input class="m-1 text-center form-control cm-form-control" type="text" id="first" maxlength="1" autocomplete="off" required/>
                                            <input class="m-1 text-center form-control cm-form-control" type="text" id="second" maxlength="1" autocomplete="off" required/>
                                            <input class="m-1 text-center form-control cm-form-control" type="text" id="third" maxlength="1" autocomplete="off" required/>
                                            <input class="m-1 text-center form-control cm-form-control" type="text" id="fourth" maxlength="1" autocomplete="off" required/>
                                            <input class="m-1 text-center form-control cm-form-control" type="text" id="fifth" maxlength="1" autocomplete="off" required/>
                                            <input class="m-1 text-center form-control cm-form-control" type="text" id="sixth" maxlength="1" autocomplete="off" required/>
                                        </div>
                                    </div>
                                    <div class="pt-4 d-flex justify-content-center">
                                        <button type="submit" id="otpSubmit" class="btn btn-primary btn-lg col-12 col-sm-8 col-lg-6" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <div class="simple-footer">
                            PT Gantari Bawana &copy; 2021
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    
    <!-- JS Libraies -->
    
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    
    <script>
        
        /*  This is for switching back and forth the input box for user experience */
        const inputs = document.querySelectorAll('#OTPInput > *[id]');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('keydown', function(event) {
                if (event.key === "Backspace") {
                    
                    if (inputs[i].value == '') {
                        if (i != 0) {
                            inputs[i - 1].focus();
                        }
                    } else {
                        inputs[i].value = '';
                    }
                    
                } else if (event.key === "ArrowLeft" && i !== 0) {
                    inputs[i - 1].focus();
                } else if (event.key === "ArrowRight" && i !== inputs.length - 1) {
                    inputs[i + 1].focus();
                } else if (event.key != "ArrowLeft" && event.key != "ArrowRight") {
                    inputs[i].setAttribute("type", "text");
                    inputs[i].value = ''; // Bug Fix: allow user to change a random otp digit after pressing it
                }
            });
            inputs[i].addEventListener('input', function() {
                inputs[i].value = inputs[i].value.toUpperCase(); // Converts to Upper case. Remove .toUpperCase() if conversion isnt required.
                if (i === inputs.length - 1 && inputs[i].value !== '') {
                    return true;
                } else if (inputs[i].value !== '') {
                    inputs[i + 1].focus();
                }
            });
            
        }
        /*  This is to get the value on pressing the submit button
        *   In this example, I used a hidden input box to store the otp after compiling data from each input fields
        *   This hidden input will have a name attribute and all other single character fields won't have a name attribute
        *   This is to ensure that only this hidden input field will be submitted when you submit the form */
        
        document.getElementById('otpSubmit').addEventListener("click", function() {
            const inputs = document.querySelectorAll('#OTPInput > *[id]');
            let compiledOtp = '';
            for (let i = 0; i < inputs.length; i++) {
                compiledOtp += inputs[i].value;
            }
            document.getElementById('otp').value = compiledOtp;
            return true;
        });
    </script>
    <!-- Page Specific JS File -->
</body>
</html>
