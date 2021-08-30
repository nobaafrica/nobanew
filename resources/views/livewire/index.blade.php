@push('styles')
    <link rel="stylesheet" href="{{ ('assets/libs/owl.carousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ ('assets/libs/owl.carousel/assets/owl.theme.default.min.css') }}">
@endpush
@push('scripts')
    <!-- owl.carousel js -->
    <script src="{{ ('assets/libs/owl.carousel/owl.carousel.min.js') }}" defer></script>
    <!-- auth-2-carousel init -->
    <script src="{{ ('assets/js/pages/auth-2-carousel.init.js') }}" defer></script>
@endpush
<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-xl-8">
                <div class="auth-full-bg pt-lg-5 p-4">
                    <div class="w-100">
                        <div class="bg-overlay"></div>
                        <div class="d-flex h-100 flex-column">

                            <div class="p-4 mt-auto">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7">
                                        <div class="text-center">
                                            
                                            
                                            <div dir="ltr">
                                                <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                    <div class="item">
                                                        <div class="py-3">
                                                            <h4 class="font-size-24 text-white mb-4">" Enhancing Africa’s food systems. "</h4>

                                                            {{-- <div>
                                                                <h4 class="font-size-24 text-white text-primary">Abs1981</h4>
                                                                <p class="font-size-14 mb-0">- Skote User</p>
                                                            </div> --}}
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="item">
                                                        <div class="py-3">
                                                            <h4 class="font-size-24 text-white mb-4">" Enhancing Africa’s food systems. "</h4>

                                                            {{-- <div>
                                                                <h4 class="font-size-16 text-primary">nezerious</h4>
                                                                <p class="font-size-14 mb-0">- Skote User</p>
                                                            </div> --}}
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->

            <div class="col-xl-4">
                <div class="auth-full-page-content p-md-5 p-4">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5">
                                <a href="{{route('/')}}" class="d-block auth-logo">
                                    <img src="assets/images/logo-dark.png" alt="" height="58" class="auth-logo-dark">
                                    <img src="assets/images/logo-light.png" alt="" height="58" class="auth-logo-light">
                                </a>
                            </div>
                            <div class="my-auto">
                                
                                <div>
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Let's earn sustainably</p>
                                </div>
    
                                <div class="mt-4">
                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">  
                                            <x-label for="email" class="form-label" :value="__('Email')" />
                                            <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="Enter email" required autofocus />
                                        </div>
                
                                        <div class="mb-3">
                                            @if (Route::has('password.request'))
                                            <div class="float-end">
                                                <a  href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                            </div>
                                            @endif
                                            <x-label class="form-label" for="password" :value="__('Password')" />
                                            <div class="input-group auth-pass-inputgroup">
                                                <x-input id="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" type="password" name="password" required autocomplete="current-password" />
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>
                
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-check" name="remember">
                                            <label class="form-check-label" for="remember-check">
                                                Remember me
                                            </label>
                                        </div>
                                        
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                        </div>

                                    </form>
                                    <div class="mt-5 text-center">
                                        <p>Don't have an account ? <a href="{{route('register')}}" class="fw-medium text-primary"> Signup now </a> </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear());</script> {{config('app.name')}}. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand</p>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>

