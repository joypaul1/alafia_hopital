<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css"
        href="https://colorlib.com/etc/lf/Login_v4/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://preview.colorlib.com/theme/bootstrap/login-form-06/css/style.css">

    <title>admin-login</title>
</head>
<style>
    .login100-form-title {
        display: block;
        /* font-family: Poppins-Bold; */
        /* font-size: 39px; */
        /* color: #333; */
        /* line-height: 1.2; */
        text-align: center;
    }
</style>

<body>
    <div class="d-lg-flex half">
        <div class="contents order-1 order-md-2">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div class="mb-4">
                            <img src="{{ asset('/assets/login/logo.png') }}"
                                style="width: 150px; margin:0 auto; display:block;" alt="">
                        </div>
                        <form action="{{ route('backend.admin.login') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group first">
                                <label for="email" style="color:black;">Email</label>
                                <input type="email" name="email" required class="form-control" id="email"
                                    autocomplete="off" value="{{ null }}" @error('email') is-invalid @enderror>
                            </div>
                            @error('email')
                                <p class="text-danger text-center" style="font-size: 14px;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                            <div class="form-group last mb-3">
                                <label for="password" style="color:black;">Password</label>
                                <input type="password" name="password" required class="form-control" id="password"
                                    autocomplete="off" value="{{ null }}"
                                    @error('password') is-invalid @enderror>
                                @error('password')
                                    <p class="text-danger text-center" style="font-size: 14px;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                            <input type="submit" value="Log In" class="btn btn-block btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg order-2 order-md-1"
            style="background-image: url('{{ asset('/assets/login/logo.jpg') }}'); background-position:center;">
        </div>

    </div>



    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <script src="https://preview.colorlib.com/theme/bootstrap/login-form-06/js/main.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
