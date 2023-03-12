<div class="limiter">
    <div class="container-login100"
        style="background-image: url('{{ asset('assets/backend/images/auth/bg-theme.png') }}');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" action="{{ route('backend.admin.login') }}" method="POST">
                @csrf
                @method('POST')

                <span class="login100-form-title">
                    <img src="{{ asset('assets/frontend/imgs/theme/iconlogo.png') }}" alt="" srcset=""
                        style="height:100px">
                </span>
                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" name="email" @error('email') is-invalid @enderror"
                        placeholder="Type your username" autocomplete="off" />
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" @error('password') is-invalid @enderror"
                        placeholder="Type your password" autocomplete="off" />
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                    @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-right p-t-8 p-b-31">
                    {{-- <a href="#">
                        Forgot password?
                    </a> --}}
                </div>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>