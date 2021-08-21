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
                                            
                                            <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">5k</span>+ Satisfied clients</h4>
                                            
                                            <div dir="ltr">
                                                <div class="owl-carousel owl-theme auth-review-carousel" id="auth-review-carousel">
                                                    <div class="item">
                                                        <div class="py-3">
                                                            <p class="font-size-16 mb-4">" Fantastic theme with a ton of options. If you just want the HTML to integrate with your project, then this is the package. You can find the files in the 'dist' folder...no need to install git and all the other stuff the documentation talks about. "</p>

                                                            <div>
                                                                <h4 class="font-size-16 text-primary">Abs1981</h4>
                                                                <p class="font-size-14 mb-0">- Skote User</p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="item">
                                                        <div class="py-3">
                                                            <p class="font-size-16 mb-4">" If Every Vendor on Envato are as supportive as Themesbrand, Development with be a nice experience. You guys are Wonderful. Keep us the good work. "</p>

                                                            <div>
                                                                <h4 class="font-size-16 text-primary">nezerious</h4>
                                                                <p class="font-size-14 mb-0">- Skote User</p>
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
                                    <h5 class="text-primary">Register account</h5>
                                    <p class="text-muted">Get your free {{config('app.name')}} account now.</p>
                                </div>
    
                                <div class="mt-4">
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                    <form class="needs-validation" novalidate method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <x-label for="useremail" class="form-label" :value="__('Email')" />
                                            <x-input id="useremail" class="form-control" type="email" placeholder="Enter email"  name="email" :value="old('email')" required />
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>       
                                            @enderror      
                                        </div>
                
                                        <div class="mb-3">
                                            <x-label for="userpassword" class="form-label" :value="__('Password')" />
                                            <x-input id="userpassword" class="form-control" type="password" name="password" placeholder="Enter password" required autocomplete="new-password" />
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>       
                                            @enderror      
                                        </div>

                                        <div class="mb-3">
                                            <x-label for="password_confirmation" class="form-label" :value="__('Confirm Password')" />
                                            <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Confirm password" required autocomplete="confirm-password" />
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>       
                                            @enderror      
                                        </div>

                                        <div class="mb-3">
                                            <x-label class="form-label" for="referral_code" :value="__('Referral Code')" />
                                            <x-input id="referral_code" class="form-control" type="text" name="referral_code" placeholder="Enter Referral Code" :value="old('referral_code')"/>
                                            @error('referral_code')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>       
                                            @enderror 
                                        </div>

                                        <div>
                                            <p class="mb-0">By registering you agree to the {{config('app.name')}} <a href="#" class="text-primary">Terms of Use</a></p>
                                        </div>
                                        
                                        <div class="mt-4 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Register</button>
                                        </div>

                                    </form>

                                    <div class="mt-5 text-center">
                                        <p>Already have an account ? <a href="{{route('/')}}" class="fw-medium text-primary"> Login</a> </p>
                                    </div>

                                </div>
                            </div>

                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear());</script> {{config('app.name')}}.</p>
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
